<?php
/**
 * Gugliotti_News_Block_Adminhtml_Category_Grid
 */

/**
 * Class Gugliotti_News_Block_Adminhtml_Category_Grid
 *
 * Adminhtml Category Grid.
 * @author Andre Gugliotti <andre@gugliotti.com.br>
 * @version 0.1.0
 * @package Training Modules
 * @license GNU General Public License, version 3
 */
class Gugliotti_News_Block_Adminhtml_Category_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	/**
	 * Gugliotti_News_Block_Adminhtml_Category_Grid constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->setId('category_id');
		$this->setDefaultSort('category_id');
		$this->setDefaultDir('asc');
		$this->setSaveParametersInSession(true);
	}

	/**
	 * _prepareCollection
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareCollection()
	{
		$collection = Mage::getModel('gugliotti_news/category')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	/**
	 * _prepareColumns
	 *
	 * Prepare each column of grid.
	 * @return Gugliotti_News_Block_Adminhtml_Category_Grid
	 */
	protected function _prepareColumns()
	{
		// adding columns
        try {
            $this->addColumn(
                'category_id',
                array(
                    'index' => 'category_id',
                    'header' => $this->__('ID'),
                    'width' => 50,
                    'type' => 'number',
                )
            );
            $this->addColumn(
                'code',
                array(
                    'index' => 'code',
                    'header' => $this->__('Code'),
                    'width' => 100,
                    'type' => 'text',
                )
            );
            $this->addColumn(
                'label',
                array(
                    'index' => 'label',
                    'header' => $this->__('Label'),
                    'type' => 'text',
                )
            );

            $statusOptions = Mage::getModel('gugliotti_news/source_status')->toGridArray();
            $this->addColumn(
                'status',
                array(
                    'index' => 'status',
                    'header' => $this->__('Status'),
                    'width' => 50,
                    'type' => 'options',
                    'options' => $statusOptions,
                    'renderer' => 'gugliotti_news/adminhtml_renderer_status'
                )
            );

            // adding actions to the last column
            $this->addColumn('action',
                array(
                    'header' =>  Mage::helper('gugliotti_news')->__('Actions'),
                    'width' => '100',
                    'type' => 'action',
                    'getter' => 'getId',
                    'actions' => array(
                        array(
                            'caption' => $this->__('Edit'),
                            'url' => array('base' => '*/*/edit'),
                            'field' => 'category_id',
                        ),
                        array(
                            'caption' => $this->__('Delete'),
                            'url' => array('base' => '*/*/delete'),
                            'field' => 'category_id',
                            'confirm' => $this->__('Are you sure you want to do this?'),
                        )
                    ),
                    'filter' => false,
                    'sortable' => false,
                    'index' => 'stores',
                    'is_system' => true,
                )
            );
        } catch (Exception $e) {
            Mage::logException($e);
        }

		// adding mass actions
		$this->addExportType(
			'*/*/exportCsv',
			$this->__('CSV')
		);
		$this->addExportType(
			'*/*/exportXml',
			$this->__('XML')
		);
		return parent::_prepareColumns();
	}

	/**
	 * _prepareMassaction
	 *
	 * Prepare mass actions fields.
	 * @return Mage_Adminhtml_Block_Widget_Grid
	 */
	protected function _prepareMassaction()
	{
		// define entity id
		$this->setMassactionIdField('category_id');
		$this->getMassactionBlock()->setData('form_field_name', 'categories');

		// delete mass action
		$this->getMassactionBlock()->addItem(
			'delete',
			array(
				'label' => $this->__('Delete'),
				'url' => $this->getUrl('*/*/massDelete'),
				'confirm' => $this->__('Are you sure you want to do this?'),
			)
		);

		// update status mass action
        $statusValues = Mage::getModel('gugliotti_news/source_status')->toOptionArray();
		$this->getMassactionBlock()->addItem(
			'status',
			array(
				'label' => $this->__('Update Status'),
				'url' => $this->getUrl('*/*/massStatus', array('_current' => true)),
				'additional' => array(
					'visibility' => array(
						'name' => 'status',
						'type' => 'select',
						'class' => 'required-entry',
						'label' => $this->__('Status'),
						'values' => $statusValues,
					)
				),
			)
		);

		return parent::_prepareMassaction();
	}

	/**
	 * getRowUrl
	 *
	 * Prepare row URL, linking to edit action.
	 * @param Varien_Object $row
	 * @return string
	 */
	public function getRowUrl($row)
	{
		return $this->getUrl('*/*/edit', array('category_id' => $row->getId()));
	}
}
