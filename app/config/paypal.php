<?php
return array(
    // set your paypal credential
    'client_id' => 'ARLGLxAh3fPk8LVnfKxZ5M2ExgQoavV9e9UZFmnGCextueL67KHJg8QEXl5f',
    'secret' => 'EEC_3xAx0miGXfMbJyiV_yY9zH-P68soDRwBAzYG3ryw7avuoPmnbfMCzfDU',

    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);