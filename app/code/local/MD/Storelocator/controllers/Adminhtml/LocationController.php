<?php
class MD_Storelocator_Adminhtml_LocationController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/storelocator');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Store Locations'), Mage::helper('adminhtml')->__('Store Locations'));
        $this->_addContent($this->getLayout()->createBlock('storelocator/adminhtml_location'));

        $this->renderLayout();
    }

    public function editAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/storelocator');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Store Locations'), Mage::helper('adminhtml')->__('Store Locations'));

        $this->_addContent($this->getLayout()->createBlock('storelocator/adminhtml_location_edit'))
            ->_addLeft($this->getLayout()->createBlock('storelocator/adminhtml_location_edit_tabs'));
        $version = substr(Mage::getVersion(), 0, 3);
			
				$this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
			
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->editAction();
    }

     public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {

            if(isset($_FILES['image_store']['name']) && $_FILES['image_store']['name'] != '') {
                try {

                    $uploader = new Varien_File_Uploader('image_store');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . DS . 'storelocator' . DS;
                    $result = $uploader->save($path, $_FILES['image_store']['name']);

                    $data['image_store'] = 'storelocator/'.$result['file'];
                    
                } catch (Exception $e) {

                }
            } else {
                if(isset($data['image_store']['delete']) && $data['image_store']['delete'] == 1) {
                    $data['image_store'] = '';
                } else {
                    unset($data['image_store']);
                }
            }

            try {
                $model = Mage::getModel('storelocator/location')
                    //->addData($this->getRequest()->getParams())
                    ->setId($this->getRequest()->getParam('id'))
                    
                    ->setCountryCode($this->getRequest()->getParam('country_code'))
                    ->setOrdinateCountry($this->getRequest()->getParam('ordinate_country'))
                    ->setOrdinateStore($this->getRequest()->getParam('ordinate_store'))             
                    ->setTitle($this->getRequest()->getParam('title'))
                    ->setImageStore($data['image_store'])
                    ->setNotes($this->getRequest()->getParam('notes'))
                    ->setOpenHours($this->getRequest()->getParam('open_hours'))
                    ->setAddressDisplay($this->getRequest()->getParam('address_display'))
                    ->setNotes($this->getRequest()->getParam('notes'))
                    ->setWebsiteUrl($this->getRequest()->getParam('website_url'))
                    ->setPhone($this->getRequest()->getParam('phone'))
                    ->setShipVendor($this->getRequest()->getParam('ship_vendor'))
					->setProgramProducts($this->getRequest()->getParam('program_products'))
					->setSpecialFeatures($this->getRequest()->getParam('special_features'))
					->setCategoryDealer($this->getRequest()->getParam('category_dealer'))
					->setFilter4($this->getRequest()->getParam('filter4'))
					->setFilter5($this->getRequest()->getParam('filter5'))
                ;
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Store location was successfully saved'));

                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if( $this->getRequest()->getParam('id') > 0 ) {
            try {
                $model = Mage::getModel('storelocator/location');
                /* @var $model Mage_Rating_Model_Rating */
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Store location was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $storeIds = $this->getRequest()->getParam('store');
        if(!is_array($storeIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select store(s)'));
        } else {
            try {
                foreach ($storeIds as $storeId) {
                    $store = Mage::getModel('storelocator/location')->load($storeId);
                    $store->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($storeIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _isAllowed()
    {
            return Mage::getSingleton('admin/session')->isAllowed('cms/storelocator');
    }

    protected function _validateSecretKey()
    {
        if ($this->getRequest()->getActionName()=='updateEmptyGeoLocations') {
            return true;
        }
        return parent::_validateSecretKey();
    }

    public function updateEmptyGeoLocationsAction()
    {
        set_time_limit(0);
        ob_implicit_flush();
        $collection = Mage::getModel('storelocator/location')->getCollection();
        $collection->getSelect()->where('latitude=0');
        foreach ($collection as $loc) {
            echo $loc->getTitle()."<br/>";
            $loc->save();
        }
        exit;
    }
}