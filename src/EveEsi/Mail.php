<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveEsi\Character;
use EveSSO\EveSSO;
use EveSSO\MailHeader;
use EveEsi\Scopes;

use EveSSO\Exceptions\InvalidScopeException;

use Carbon\Carbon;

class Mail extends BaseEsi {
    /**
     * @var Esi
     */
    private $esi;

    /**
     * @var Character
     */
    private $esi_char;

    public function __construct(Esi $e, Character $esi_char) {
        parent::__construct();
        $this->esi = $e;
        $this->esi_char = $esi_char;
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMailHeaders(EveSSO $sso) {
        $uri = sprintf('characters/%s/mail/', $sso->character_id);

        if ($this->commit_data) {
            $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_mail-' . $sso->character_id]);
            $return = $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_READ, $expires);
            if (!$return) {
                return CorporationContract::whereCorporationId($public->corporation_id)->get()->toArray();
            } else {
                $mail_headers = array();
                foreach($return as $mail_header) {
                    $mail_header['character_id'] = $sso->character_id;
                    if (array_key_exists('timestamp', $mail_header)) {
                        $mail_header['timestamp'] = new Carbon($mail_header['timestamp']);
                    }
                    array_push($mail_headers, MailHeader::updateOrCreate(['mail_id' => $mail_header['mail_id']], $mail_header));
                }
                return $mail_headers;
            }
        } else {
            return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_READ);
        }
    }

    /**
     * scopes required: esi-mail.send_mail.v1
     * method: post
     */
    public function sendMail(EveSSO $sso, string $body, string $subject, int $approved_cspa = 0, EveSSO ...$recipients) {
        $res = [];
        foreach($recipients as $recipient) {
            array_push($res, new Recipient($recipient));
        }

        $mail = new EMail();
        $mail->recipients = $res;
        $mail->body = $body;
        $mail->approved_cost = $approved_cspa;
        $mail->subject = $subject;
        
        $uri = sprintf('characters/%s/mail/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_SEND, null, 'POST', $mail);
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: delete
     */
    public function deleteMail(EveSSO $sso, number $mail_id) {
        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_ORGANIZE, null, 'DELETE');
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMail(EveSSO $sso, number $mail_id) {
        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_READ);
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: put
     */
    public function updateMail(EveSSO $sso, number $mail_id) {
        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_ORGANIZE, null, 'PUT');
        return true;
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMailLabels(EveSSO $sso) {
        $uri = sprintf('characters/%s/mail/labels/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_READ);
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: post
     */
    public function createMailLabel(EveSSO $sso) {
        $uri = sprintf('characters/%s/mail/labels/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_ORGANIZE, null, 'POST');
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: delete
     */
    public function deleteMailLabel(EveSSO $sso, number $label_id) {
        $uri = sprintf('characters/%s/mail/labels/%s/', $sso->character_id);

        $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_ORGANIZE, null, 'DELETE');
        return true;
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMailLists(EveSSO $sso) {
        $uri = sprintf('characters/%s/mail/lists/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], Scopes::MAIL_READ);
    }
}

class Recipient {
    public $recipient_id = 0;
    public $recipient_type = 'character';

    public function __construct(EveSSO $sso) {
        $this->recipient_id = $sso->character_id;
    }
}

class EMail {
    public $approved_cost = 0;
    public $body = '';
    public $recipients = [];
    public $subject = '';
}
