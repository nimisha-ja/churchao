<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    // Sender email and name
    public string $fromEmail  = 'church@ephphathaglobal.com';
    public string $fromName   = 'St. Alphonsa Church';

    // Optional: default recipients
    public string $recipients = '';

    public string $userAgent = 'CodeIgniter';

    // Use SMTP
    public string $protocol = 'smtp';

    // SMTP Server Hostname
    public string $SMTPHost = 'ephphathaglobal.com';

    // SMTP Username (your email)
    public string $SMTPUser = 'church@ephphathaglobal.com';

    // SMTP Password (email account password)
    public string $SMTPPass = '.HiUx(nC1]Xi';

    // SMTP Port (465 for SSL)
    public int $SMTPPort = 465;

    // Use SSL encryption
    public string $SMTPCrypto = 'ssl';

    // SMTP timeout (seconds)
    public int $SMTPTimeout = 5;

    // Keep SMTP connection alive
    public bool $SMTPKeepAlive = false;

    // Enable word-wrap
    public bool $wordWrap = true;

    // Character count to wrap at
    public int $wrapChars = 76;

    // Set mail type to HTML
    public string $mailType = 'html';

    // Character set
    public string $charset = 'UTF-8';

    // Disable email address validation (optional)
    public bool $validate = false;

    // Email priority (normal = 3)
    public int $priority = 3;

    // Newline character
    public string $CRLF = "\r\n";
    public string $newline = "\r\n";

    // Disable BCC Batch Mode
    public bool $BCCBatchMode = false;
    public int $BCCBatchSize = 200;

    // Disable DSN notifications
    public bool $DSN = false;
}