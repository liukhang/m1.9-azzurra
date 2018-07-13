<?php
class MD_Storelocator_Block_Adminhtml_Country_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('locationsGrid');
        $this->setDefaultSort('country_id');
        $this->setDefaultDir('ASC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $this->setCollection(Mage::getModel('storelocator/country')->getCollection());
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('country_id', array(
            'header'    => Mage::helper('storelocator')->__('ID'),
            'align'     => 'center',
            'width'     => '100px',
            'index'     => 'country_id',
            //'type'      => 'number',
        ));

        // $this->addColumn('country', array(
        //     'header'    => Mage::helper('storelocator')->__('Country'),
        //     'align'     => 'left',
        //     'index'     => 'country_code',
        // ));

        $this->addColumn('country_code', array(
          'header'    => Mage::helper('storelocator')->__('Country'),
          'align'     => 'left',
          'width'     => '700px',
          'index'     => 'country_code',
          'renderer' => 'Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Country',
        ));

        // $this->addColumn('ordinate_country', array(
            // 'header'    => Mage::helper('storelocator')->__('Ordinate country'),
            // 'align'     => 'center',
            // 'index'     => 'ordinate_country',
            // 'width'     => '50px',
            //'type'      => 'number',
        // ));

        // $this->addColumn('image_flag', array(
                // 'header'=> Mage::helper('storelocator')->__('Image'),
                // 'type' => 'image',
                // 'renderer'  => 'storelocator/adminhtml_renderer_image',
                // 'width' => 64,
                // 'index' => 'image_country',
        // ));

        // $this->addColumn('website_url', array(
        //     'header'    => Mage::helper('storelocator')->__('URL'),
        //     'index'     => 'website_url',
        // ));

        // $this->addColumn('phone', array(
        //     'header'    => Mage::helper('storelocator')->__('Phone'),
        //     'index'     => 'phone',
        // ));

        Mage::dispatchEvent('storelocator_adminhtml_grid_prepare_columns', array('block'=>$this));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('country_id');
        $this->getMassactionBlock()->setFormFieldName('flag');

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