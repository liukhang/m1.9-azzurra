<?php
class MD_Storelocator_Block_Adminhtml_Location_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
		$name_filter1=Mage::getStoreConfig('storelocator/setting/name1');
		$name_filter2=Mage::getStoreConfig('storelocator/setting/name2');
		$name_filter3=Mage::getStoreConfig('storelocator/setting/name3');
		$name_filter4=Mage::getStoreConfig('storelocator/setting/name4');
		$name_filter5=Mage::getStoreConfig('storelocator/setting/name5');

		$_filter1 = Mage::getStoreConfig('storelocator/setting/enabled1');
		$_filter2 = Mage::getStoreConfig('storelocator/setting/enabled2');
		$_filter3 = Mage::getStoreConfig('storelocator/setting/enabled3');
		$_filter4 = Mage::getStoreConfig('storelocator/setting/enabled4');
		$_filter5 = Mage::getStoreConfig('storelocator/setting/enabled5');
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('country_form', array(
            'legend'=>Mage::helper('storelocator')->__('Store Location Country')
        ));
        $fieldset->addField('country_code', 'select', array(
            'name'  => 'country_code',
            'label'     => 'Country',
            'values'    => Mage::getModel('storelocator/system_config_country')->toOptionArray(),
            'onchange' => 'getstate(this)',
            'class'     => 'required-entry',
            'required'  => true,
        ));

        $fieldset = $form->addFieldset('location_form', array(
            'legend'=>Mage::helper('storelocator')->__('Store Location Info')
        ));
		$fieldset->addField('ordinate_store', 'text', array(
            'name'      => 'ordinate_store',
            'label'     => Mage::helper('storelocator')->__('Ordinate store'),
            'note'      => Mage::helper('storelocator')->__('example: 41.051986, 16.561551099999974'),
            'class'     => 'required-entry',
            'required'  => true,
        ));

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('storelocator')->__('Title'),
            'class'     => 'required-entry',
            'required'  => true,
        ));

        // $fieldset->addField('image_store', 'image', array(
            // 'name'      => 'image_store',
            // 'label'     => Mage::helper('storelocator')->__('Store image'),
            // 'class'     => 'required-entry',
            // 'required'  => true,
        // ));

        $fieldset->addField('address_display', 'textarea', array(
            'name'      => 'address_display',
            'label'     => Mage::helper('storelocator')->__('Address to be displayed'),
            'class'     => 'required-entry',
            'style'     => 'height:50px',
            'required'  => true,
            'note'      => Mage::helper('storelocator')->__('This address will be shown to visitor and should have multiple lines formatting'),
        ));

        $fieldset->addField('phone', 'text', array(
            'name'      => 'phone',
            'label'     => Mage::helper('storelocator')->__('Phone'),
        ));

        $fieldset->addField('website_url', 'text', array(
            'name'      => 'website_url',
            'label'     => Mage::helper('storelocator')->__('Website URL / Email'),
            'note'      => Mage::helper('storelocator')->__('For websites URL please start with http://'),
        ));

        $fieldset->addField('notes', 'textarea', array(
            'name'      => 'notes',
            'style'     => 'height:50px',
            'label'     => Mage::helper('storelocator')->__('Notes'),
        ));

  
            $fieldset->addField('open_hours', 'editor', array(
                'name' => 'open_hours',
                'label' => Mage::helper('storelocator')->__('Open Hours'),
                'title' => Mage::helper('storelocator')->__('Open Hours'),
                'style' => 'width:600px; height:250px;',
                'config' => Mage::getSingleton('storelocator/config')->getConfig(),
                'wysiwyg' => true,
            ));
		$fieldset = $form->addFieldset('product_form', array(
            'legend'=>Mage::helper('storelocator')->__('Store Location Product')
        ));
		if($_filter1=='1'){
			$fieldset->addField('program_products', 'text', array(
				'name'      => 'program_products',
				'label'     => Mage::helper('storelocator')->__($name_filter1),
			));
		}
		if($_filter2=='1'){
			$fieldset->addField('special_features', 'text', array(
				'name'      => 'special_features',
				'label'     => Mage::helper('storelocator')->__($name_filter2),
			));
		}
		if($_filter3=='1'){
			$fieldset->addField('category_dealer', 'text', array(
				'name'      => 'category_dealer',
				'label'     => Mage::helper('storelocator')->__($name_filter3),
			));
		}
		if($_filter4=='1'){
			$fieldset->addField('filter4', 'text', array(
				'name'      => 'filter4',
				'label'     => Mage::helper('storelocator')->__($name_filter4),
			));
		}
		if($_filter5=='1'){
			$fieldset->addField('filter5', 'text', array(
				'name'      => 'filter5',
				'label'     => Mage::helper('storelocator')->__($name_filter5),
			));
		}


        // $fieldset->addField('ship_vendor', 'text', array(
        //     'name'      => 'ship_vendor',
        //     'style'     => 'height:50px',
        //     'label'     => Mage::helper('storelocator')->__('Open hours'),
        // ));     
        
        Mage::dispatchEvent('storelocator_adminhtml_edit_prepare_form', array('block'=>$this, 'form'=>$form));

        if (Mage::registry('location_data')) {
            $form->setValues(Mage::registry('location_data')->getData());
        }

        return parent::_prepareForm();
    }
}