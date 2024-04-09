<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tables Names
    |--------------------------------------------------------------------------
    |
    | You can change the table names depends on your application structure
    | the values in the below tables, is the current table name, and if
    | are happy with it, leave it as it is, if not. You may read the related
    | instruction before you change the values.
    |
    */
    'table_names' => [
        /**
         * Tickets table
         */
        'tickets' => 'tickets',
        /**
         * Categories table for the tickets
         */
        'categories' => 'categories',
        /**
         * Messages table to appears in the ticket
         */
        'messages' => [
            'table' => 'messages',
            /**
             * This is the foreign key for associated to the ticket
             * If you renamed the ticket table, you should consider
             * changing this column as well to follow the laravel
             * convention, "table_id"
             *
             * @see https://laravel.com/docs/9.x/eloquent-relationships#one-to-many
             */
            'columns' => [
                'user_foreign_id' => 'user_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
        /**
         * Many to Many relationship between the tickets table
         * and the categories table, the above description, applies
         * to this also
         *
         * @see https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
         */
        'category_ticket' => [
            'table' => 'category_ticket',
            'columns' => [
                'category_foreign_id' => 'category_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
    ],

];
