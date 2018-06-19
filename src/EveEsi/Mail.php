<?php

namespace EveEsi;

use EveEsi\BaseEsi;
use EveEsi\Esi;
use EveEsi\Character;
use EveSSO\EveSSO;
use EveSSO\MailHeader;

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
        if (!$this->hasScope($sso, 'esi-mail.read_mail.v1')) {
            return [];
        }


        $uri = sprintf('characters/%s/mail/', $sso->character_id);

        if ($this->commit_data) {
            $expires = EsiExpireTimes::firstOrCreate(['esi_name' => 'get_character_mail-' . $sso->character_id]);
            if ($expires->expired()) {
                $return = $this->esi->callEsiAuth($sso, $uri, [], $expires);
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
                return MailHeader::whereCharacterId($sso->character_id)->get()->toArray();
            }
        } else {
            return $this->esi->callEsiAuth($sso, $uri, []);
        }
    }

    /**
     * scopes required: esi-mail.send_mail.v1
     * method: post
     */
    public function sendMail(EveSSO $sso) {
        if (!$this->hasScope($sso, 'esi-mail.send_mail.v1')) {
            return -1;
        }

        $uri = sprintf('characters/%s/mail/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], null, 'POST');
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: delete
     */
    public function deleteMail(EveSSO $sso, number $mail_id) {
        if (!$this->hasScope($sso, 'esi-mail.organize_mail.v1')) {
            return false;
        }

        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        return $this->esi->callEsiAuth($sso, $uri, [], null, 'DELETE');
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMail(EveSSO $sso, number $mail_id) {
        if (!$this->hasScope($sso, 'esi-mail.read_mail.v1')) {
            return null;
        }

        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        return $this->esi->callEsiAuth($sso, $uri, []);
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: put
     */
    public function updateMail(EveSSO $sso, number $mail_id) {
        if (!$this->hasScope($sso, 'esi-mail.organize_mail.v1')) {
            return false;
        }

        $uri = sprintf('characters/%s/mail/%s/', $sso->character_id, $mail_id);

        $this->esi->callEsiAuth($sso, $uri, [], null, 'PUT');
        return true;
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMailLabels(EveSSO $sso) {
        if (!$this->hasScope($sso, 'esi-mail.read_mail.v1')) {
            return [];
        }

        $uri = sprintf('characters/%s/mail/labels/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, []);
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: post
     */
    public function createMailLabel(EveSSO $sso) {
        if (!$this->hasScope($sso, 'esi-mail.organize_mail.v1')) {
            return -1;
        }

        $uri = sprintf('characters/%s/mail/labels/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, [], null, 'POST');
    }

    /**
     * scopes required: esi-mail.organize_mail.v1
     * method: delete
     */
    public function deleteMailLabel(EveSSO $sso, number $label_id) {
        if (!$this->hasScope($sso, 'esi-mail.organize_mail.v1')) {
            return false;
        }

        $uri = sprintf('characters/%s/mail/labels/%s/', $sso->character_id);

        $this->esi->callEsiAuth($sso, $uri, [], null, 'DELETE');
        return true;
    }

    /**
     * scopes required: esi-mail.read_mail.v1
     * method: get
     */
    public function getMailLists(EveSSO $sso) {
        if (!$this->hasScope($sso, 'esi-mail.read_mail.v1')) {
            return [];
        }

        $uri = sprintf('characters/%s/mail/lists/', $sso->character_id);

        return $this->esi->callEsiAuth($sso, $uri, []);
    }
}
