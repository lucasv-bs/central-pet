<?php

class About extends Page {
    public static function getAbout() {
        $content = View::render('pages/about', [
            'title' => 'About Page',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Possimus quaerat voluptatem dolorem voluptatum suscipit, pariatur commodi esse eum cum dicta nam? Earum fuga sunt voluptatibus deleniti itaque minus corporis non?'
        ]);

        return parent::getPage('Central Pet - About', $content);
    }
}