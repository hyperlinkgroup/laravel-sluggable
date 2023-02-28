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
     * The max length of the slug excluding the counter.
     * ATTENTION: If you change this value to above 255
     * you must also publish the migration and
     * change column type in the database.
     */
    'max_length' => 255,

    /*
     * The separator used to separate words in the slug.
     * ATTENTION: If you change this value
     * no existing slugs will be changed.
     */
    'separator' => '-',

    /*
     * The separator used to separate the slug from the counter.
     * If the slug already exists, a counter will be added.
     * ATTENTION: If you change this value
     * no existing slugs will be changed.
     */
    'counter_separator' => '_',

    /*
     * The model that will be used to generate the slug.
     * You can use your own model by extending the provided model.
     */
    'model' => Hyperlink\Sluggable\Models\Slug::class,
];
