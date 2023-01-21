<?php

class Logger
{
    private PDO $DB;

    /**
     * @param string $dsn Database address
     * @param string $user Database username
     * @param string $pass Database password
     */
    function __construct(string $dsn, string $user, string $pass) {
        $this->DB = new PDO($dsn, $user, $pass);
    }

    /**
     * Write a message to the log
     *
     * @param string $message The log message
     * @param string $ip Origin of the request that triggered the log
     */
    public function log(string $message, string $ip) : void {
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            $ip = '';
        }

        $sql = 'INSERT INTO log (message, ip, timestamp) VALUES (:message, :ip, NOW())';
        $data = [
            'message' => $message,
            'ip' => $ip
        ];

        $prepared = $this->DB->prepare($sql);
        $prepared->execute($data);
    }
}