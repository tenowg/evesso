<?php

namespace EveEsi {
    class Scopes {
        const READ_CORP_CONTRACTS = 'esi-contracts.read_corporation_contracts.v1';
        const READ_PERSONAL_CONTRACTS = 'esi-contracts.read_character_contracts.v1';
        const READ_CHARACTER_TITLES = 'esi-characters.read_titles.v1';
        const READ_CHARACTER_ASSETS = 'esi-assets.read_assets.v1';
        const READ_CHARACTER_INDUSTRY_JOBS = 'esi-industry.read_character_jobs.v1';
        const READ_CHARACTER_MINING = 'esi-industry.read_character_mining.v1';
        const READ_CHARACTER_SKILLS = 'esi-skills.read_skills.v1';
        const READ_CHARACTER_WALLET = 'esi-wallet.read_character_wallet.v1';
        const READ_CHARACTER_ROLES = 'esi-characters.read_corporation_roles.v1';
        const READ_CHARACTER_STATS = 'esi-characterstats.read.v1';
        const READ_CORP_ASSETS = 'esi-assets.read_corporation_assets.v1';
        const READ_CORP_BLUEPRINTS = 'esi-corporations.read_blueprints.v1';
        const READ_CORP_STRUCTURES = 'esi-corporations.read_structures.v1';
        const READ_CORP_TITLES = 'esi-corporations.read_titles.v1';
        const READ_CORP_INDUSTRY_JOBS = 'esi-industry.read_corporation_jobs.v1';
        const MAIL_READ = 'esi-mail.read_mail.v1';
        const MAIL_SEND = 'esi-mail.send_mail.v1';
        const MAIL_ORGANIZE = 'esi-mail.organize_mail.v1';
        const CONTACTS_CHARACTER_READ = 'esi-characters.read_contacts.v1';
        const READ_NOTIFICATIONS = 'esi-characters.read_notifications.v1';
        const READ_FLEET = 'esi-fleets.read_fleet.v1';
        const ALL_SCOPES= [
            READ_CORP_CONTRACTS,
            READ_PERSONAL_CONTRACTS,
            READ_CHARACTER_TITLES,
            READ_CHARACTER_ASSETS,
            READ_CHARACTER_INDUSTRY_JOBS,
            READ_CHARACTER_MINING,
            READ_CHARACTER_SKILLS,
            READ_CHARACTER_WALLET,
            READ_CHARACTER_ROLES,
            READ_CHARACTER_STATS,
            READ_CORP_ASSETS,
            READ_CORP_BLUEPRINTS,
            READ_CORP_STRUCTURES,
            READ_CORP_TITLES,
            READ_CORP_INDUSTRY_JOBS,
            READ_FLEET,
            MAIL_READ,
            MAIL_SEND,
            MAIL_ORGANIZE,
            CONTACTS_CHARACTER_READ,
            READ_NOTIFICATIONS
        ];
    }
}