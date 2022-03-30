<?php
/**
 * DkimPlugin for phplist.
 *
 * This file is a part of DkimPlugin.
 *
 * This plugin is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * This plugin is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * @category  phplist
 *
 * @author    Duncan Cameron
 * @copyright 2015-2022 Duncan Cameron
 * @license   http://www.gnu.org/licenses/gpl.html GNU General Public License, Version 3
 */
class DkimPlugin extends phplistPlugin
{
    const VERSION_FILE = 'version.txt';
    const PLUGIN = __CLASS__;

    public $name = 'DKIM Plugin';
    public $authors = 'Duncan Cameron';
    public $description = 'Adds DKIM headers';
    public $settings = [
        'dkim_domain' => [
            'value' => '',
            'description' => 'DKIM domain',
            'type' => 'text',
            'allowempty' => false,
            'category' => 'DKIM',
            ],
        'dkim_selector' => [
            'value' => '',
            'description' => 'DKIM selector',
            'type' => 'text',
            'allowempty' => false,
            'category' => 'DKIM',
            ],
        'dkim_identity' => [
            'value' => '',
            'description' => 'DKIM identity (optional)',
            'type' => 'text',
            'allowempty' => true,
            'category' => 'DKIM',
            ],
        'dkim_private_key' => [
            'value' => '',
            'description' => 'DKIM private key (if set, takes precedence over private key file)',
            'type' => 'textarea',
            'allowempty' => true,
            'category' => 'DKIM',
            ],
        'dkim_private_key_path' => [
            'value' => '',
            'description' => 'Path to DKIM private key file',
            'type' => 'text',
            'allowempty' => true,
            'category' => 'DKIM',
            ],
        'dkim_passphrase' => [
            'value' => '',
            'description' => 'Passphrase for DKIM private key file',
            'type' => 'text',
            'allowempty' => true,
            'category' => 'DKIM',
            ],
        'dkim_copy_header_fields' => [
            'value' => false,
            'description' => 'Include the header field values for diagnostic use',
            'type' => 'boolean',
            'allowempty' => true,
            'category' => 'DKIM',
            ],
        ];

    public function __construct()
    {
        $this->coderoot = dirname(__FILE__) . '/' . self::PLUGIN . '/';
        $this->version = file_get_contents($this->coderoot . self::VERSION_FILE);
        parent::__construct();
    }

    public function messageHeaders($mail)
    {
        $mail->DKIM_domain = getConfig('dkim_domain');
        $mail->DKIM_selector = getConfig('dkim_selector');
        $mail->DKIM_identity = getConfig('dkim_identity');
        $mail->DKIM_private_string = getConfig('dkim_private_key');
        $mail->DKIM_private = getConfig('dkim_private_key_path');
        $mail->DKIM_passphrase = getConfig('dkim_passphrase');
        $mail->DKIM_copyHeaderFields = getConfig('dkim_copy_header_fields');

        return [];
    }
}
