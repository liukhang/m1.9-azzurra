<?php
class MD_Storelocator_Adminhtml_CountryController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/storelocator');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Coordinate country'), Mage::helper('adminhtml')->__('Coordinate country'));
        $this->_addContent($this->getLayout()->createBlock('storelocator/adminhtml_country'));

        $this->renderLayout();
    }

    public function editAction()
    {
        $this->loadLayout();

        $this->_setActiveMenu('cms/storelocator');
        $this->_addBreadcrumb(Mage::helper('adminhtml')->__('Coordinate country'), Mage::helper('adminhtml')->__('Coordinate country'));

        $this->_addContent($this->getLayout()->createBlock('storelocator/adminhtml_country_edit'))
            ->_addLeft($this->getLayout()->createBlock('storelocator/adminhtml_country_edit_tabs'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->editAction();
    }

     public function saveAction()
    {
        if ( $this->getRequest()->getPost() ) {

            if(isset($_FILES['image_country']['name']) && $_FILES['image_country']['name'] != '') {
                try {

                    $uploader = new Varien_File_Uploader('image_country');
                    $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(false);

                    $path = Mage::getBaseDir('media') . DS . 'storelocator/country' . DS;
                    $result = $uploader->save($path, $_FILES['image_country']['name']);

                    $data['image_country'] = 'storelocator/country/'.$result['file'];
                    
                } catch (Exception $e) {

                }
            } else {
                if(isset($data['image_country']['delete']) && $data['image_country']['delete'] == 1) {
                    $data['image_country'] = '';
                } else {
                    unset($data['image_country']);
                }
            }

            try {
                $model = Mage::getModel('storelocator/country')
                    //->addData($this->getRequest()->getParams())
                    ->setId($this->getRequest()->getParam('id'))
					
                    ->setCountryCode($this->getRequest()->getParam('country_code'))
                    ->setOrdinateCountry($this->getRequest()->getParam('ordinate_country'))
                    // ->setOrdinateStore($this->getRequest()->getParam('ordinate_store'))				
                    // ->setTitle($this->getRequest()->getParam('title'))
                    ->setImageCountry($data['image_country'])
                    // ->setNotes($this->getRequest()->getParam('notes'))
                    // ->setAddressDisplay($this->getRequest()->getParam('address_display'))
                    // ->setNotes($this->getRequest()->getParam('notes'))
                    // ->setWebsiteUrl($this->getRequest()->getParam('website_url'))
                    // ->setPhone($this->getRequest()->getParam('phone'))
                    //->setShipVendor($this->getRequest()->getParam('ship_vendor'))
                ;
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Country was successfully saved'));

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
                $model = Mage::getModel('storelocator/country');
                /* @var $model Mage_Rating_Model_Rating */
                $model->setId($this->getRequest()->getParam('id'))
                    ->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('adminhtml')->__('Country was successfully deleted'));
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction() {
        $countryIds = $this->getRequest()->getParam('flag');
        if(!is_array($countryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select country(s)'));
        } else {
            try {
                foreach ($countryIds as $countryId) {
                    $country = Mage::getModel('storelocator/country')->load($countryId);
                    $country->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($countryIds)
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
        $collection = Mage::getModel('storelocator/country')->getCollection();
        $collection->getSelect()->where('latitude=0');
        foreach ($collection as $loc) {
            echo $loc->getTitle()."<br/>";
            $loc->save();
        }
        exit;
    }
}