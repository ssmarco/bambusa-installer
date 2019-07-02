<?php


namespace SilverStripe\Bambusa\Pages;


use JonoM\FocusPoint\Forms\FocusPointField;
use Page;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\LiteralField;

class ImagePage extends Page
{
    private static $has_one = [
        'Image' => Image::class,
    ];

    private static $table_name = 'ImagePage';

    private static $singular_name = 'ImagePage';

    private static $plural_name = 'ImagePages';

    public function getCMSFields()
    {
        $description = $this->Image()->exists()
                ? sprintf(
                    'To customise cropping, you can <a target="_blank" href="%s">edit this image</a>',
                    $this->Image()->CMSEditLink()
                )
                : null;
        $fields = parent::getCMSFields();
        $fields->addFieldsToTab('Root.Main', [
            $upload = UploadField::create('Image')
                ->setDescription($description),
        ], 'Content');
        $upload->setAllowedFileCategories('image');
        return $fields;
    }
}