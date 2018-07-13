<?php
class MD_Storelocator_Model_Location extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('storelocator/location');
    }

    public function fetchCoordinates()
    {
        $url = Mage::getStoreConfig('storelocator/general/google_geo_url');
        if (!$url) {
            $url = "http://maps.google.com/maps/geo";
        }
        $url .= strpos($url, '?')!==false ? '&' : '?';
        $url .= 'q='.urlencode(preg_replace('#\r|\n#', ' ', $this->getAddress()))."&output=csv";

        $cinit = curl_init();
        curl_setopt($cinit, CURLOPT_URL, $url);
        curl_setopt($cinit, CURLOPT_HEADER,0);
        curl_setopt($cinit, CURLOPT_USERAGENT, $_SERVER["HTTP_USER_AGENT"]);
        curl_setopt($cinit, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($cinit);
        if (!is_string($response) || empty($response)) {
            return $this;
        }
        $result = explode(',', $response);
        if (sizeof($result)!=4 || $result[0]!='200') {
            //echo '<pre>'.$response.'</pre>';
            return $this;
        }
        $this->setLatitude($result[2])->setLongitude($result[3]);
        return $this;
    }

    protected function _beforeSave()
    {
        if (!$this->getAddress()) {
            $this->setAddress($this->getAddressDisplay());
        }

        $this->setAddress(str_replace(array("\n", "\r"), " ", $this->getAddress()));

        if (!(float)$this->getLongitude() || !(float)$this->getLatitude() || $this->getRecalculate()) {
            $this->fetchCoordinates();
        }

        parent::_beforeSave();
    }
}

