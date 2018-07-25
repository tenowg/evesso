<?php

namespace EveEsi {
    class Scopes {
        const READ_CORP_CONTRACTS = 'esi-contracts.read_corporation_contracts.v1';
        const READ_PERSONAL_CONTRACTS = 'esi-contracts.read_character_contracts.v1';
        const READ_CHARACTER_TITLES = 'esi-characters.read_titles.v1';
        const READ_CHARACTER_ASSETS = 'esi-assets.read_assets.v1';
        const READ_CORP_TITLES = 'esi-corporations.read_titles.v1';
        const MAIL_READ = 'esi-mail.read_mail.v1';
        const MAIL_SEND = 'esi-mail.send_mail.v1';
        const MAIL_ORGANIZE = 'esi-mail.organize_mail.v1';
        const CONTACTS_CHARACTER_READ = 'esi-characters.read_contacts.v1';
    }
}