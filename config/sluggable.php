<?php

// config for Hyperlink/Sluggable
return [
    /*
     * The name of the table that will store the slugs.
     */
    'table' => 'slugs',

    /*
     * The name of the column that will store the slug.
     */
    'column' => 'slug',

    /*
     * The maximum length of the slug.
     * ATTENTION: If you change this value to above 255
     * you must also publish the migration and
     * change column type in the database.
     */
    'length' => 255,

    /*
     * The separator used to separate words in the slug.
     * ATTENTION: If you change this value
     * no existing slugs will be changed.
     */
    'separator' => '-',
];
