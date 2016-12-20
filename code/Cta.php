<?php

class CtaBlock extends DataObject
{
	private static $db = array(
		'Title' => 'Varchar(255)',
		'Align' => "Enum('Left,Center,Right','Left')",
		'EmbedCode' => 'Text',
		'Link' => 'Link',
	);

	private static $has_one = array(
		'Image' => 'Image'
	);

	private static $summary_fields = array(
		'Title' => 'Title'
	);

	public function getCMSFields()
	{
		$fields = parent::getCMSFields();
		$fields->dataFieldByName('Title')->setDescription('Internal Use Only');
		$fields->replaceField('EmbedCode', CodeeditorField::create('EmbedCode')
			->addExtraClass('stacked')
			->setMode('html')
			->setRows(10)
		);
		$fields->insertBefore( TextField::create('ShortCode','Short Code')->setValue($this->GenerateShortCode())->setAttribute('readonly','readonly'), 'Title');
		$fields->insertBefore( HeaderField::create('head1','Embeded CTA',2), 'EmbedCode' );
		$fields->insertBefore( $fields->dataFieldByName('Image')
			->setAllowedExtensions(array('jpg','jpeg','png','gif'))
			->setFolderName('Uploads/cta'), 'Link' );
		$fields->insertBefore( HeaderField::create('head2','Generated CTA',2), 'Image' );
		$fields->replaceField('Link',LinkField::create('Link','Link') );
		return $fields;
	}

	public function canCreate($member = null) { return true; }
	public function canDelete($member = null) { return true; }
	public function canEdit($member = null)   { return true; }
	public function canView($member = null)   { return true; }

	public function GenerateShortCode()
	{
		return ($this->ID) ? '[cta, id="'.$this->ID.'"]' : null;
	}
	
	public function forTemplate()
	{
		return $this->renderWith(array('cta'));
	}
	
	public static function ParseShortCode($args, $content=null, $parser=null, $tagname=null)
	{
		return ($cta = CtaBlock::get()->byID($args['id'])) ? $cta->forTemplate() : null;
	}
}