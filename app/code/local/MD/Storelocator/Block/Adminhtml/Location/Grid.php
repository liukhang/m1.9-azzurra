<?php
class MD_Storelocator_Block_Adminhtml_Location_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('locationsGrid');
        $this->setDefaultSort('location_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('storelocator/location')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('location_id', array(
            'header'    => Mage::helper('storelocator')->__('ID'),
            'align'     => 'right',
            'width'     => '50px',
            'index'     => 'location_id',
            'type'      => 'number',
        ));

        // $this->addColumn('country', array(
        //     'header'    => Mage::helper('storelocator')->__('Country'),
        //     'align'     => 'left',
        //     'index'     => 'country_code',
        // ));

        $this->addColumn('country', array(
          'header'    => Mage::helper('storelocator')->__('Country'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'country_code',
          'renderer' => 'Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Country',
        ));

		
        $this->addColumn('title', array(
            'header'    => Mage::helper('storelocator')->__('Title'),
            'align'     => 'left',
            'index'     => 'title',
        ));

        $this->addColumn('address', array(
            'header'    => Mage::helper('storelocator')->__('Address'),
            'align'     => 'left',
            'index'     => 'address_display',
        ));

        $this->addColumn('website_url', array(
            'header'    => Mage::helper('storelocator')->__('URL'),
            'index'     => 'website_url',
        ));

        $this->addColumn('phone', array(
            'header'    => Mage::helper('storelocator')->__('Phone'),
            'index'     => 'phone',
        ));

        // $this->addColumn('ordinate_country', array(
        //     'header'    => Mage::helper('storelocator')->__('Ordinate country'),
        //     'align'     => 'right',
        //     'index'     => 'ordinate_country',
        //     'width'     => '50px',
        //     //'type'      => 'number',
        // ));

        $this->addColumn('ordinate_store', array(
            'header'    => Mage::helper('storelocator')->__('Ordinate store'),
            'align'     => 'right',
            'index'     => 'ordinate_store',
            'width'     => '50px',
            //'type'      => 'number',
        ));

        Mage::dispatchEvent('storelocator_adminhtml_grid_prepare_columns', array('block'=>$this));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('location_id');
        $this->getMassactionBlock()->setFormFieldName('store');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('storelocator')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('storelocator')->__('Are you sure?')
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }

}