<?php
class MD_Storelocator_Block_Adminhtml_Country_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('country_form', array(
            'legend'=>Mage::helper('storelocator')->__('Info Country')
        ));
        $fieldset->addField('country_code', 'select', array(
            'name'  => 'country_code',
            'label'     => 'Country',
            'values'    => Mage::getModel('adminhtml/system_config_source_country') ->toOptionArray(),
            'onchange' => 'getstate(this)',
            'class'     => 'required-entry',
            'required'  => true,
        ));

        // $fieldset->addField('ordinate_country', 'text', array(
            // 'name'      => 'ordinate_country',
            // 'label'     => Mage::helper('storelocator')->__('Ordinate Countries'),
            //'note'      => Mage::helper('storelocator')->__('If empty, will attempt to retrieve using the geo location address.'),
            // 'class'     => 'required-entry',
            // 'required'  => true,
        // ));

        // $fieldset->addField('image_country', 'image', array(
            // 'name'      => 'image_country',
            // 'label'     => Mage::helper('storelocator')->__('Country image'),
            // 'class'     => 'required-entry',
            // 'required'  => true,
        // ));

        // $fieldset->addField('phone', 'text', array(
            // 'name'      => 'phone',
            // 'label'     => Mage::helper('storelocator')->__('Phone'),
        // ));

        // $fieldset->addField('website_url', 'text', array(
            // 'name'      => 'website_url',
            // 'label'     => Mage::helper('storelocator')->__('Website URL / Email'),
            // 'note'      => Mage::helper('storelocator')->__('For websites URL please start with http://'),
        // ));

        Mage::dispatchEvent('storelocator_adminhtml_edit_prepare_form', array('block'=>$this, 'form'=>$form));

        if (Mage::registry('country_data')) {
            $form->setValues(Mage::registry('country_data')->getData());
        }

        return parent::_prepareForm();
    }
}