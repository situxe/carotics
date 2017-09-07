<?php

class shopSeofilterSettingsModel extends waModel
{
    const GENERAL_STOREFRONT = 'general';

    protected $table = 'shop_seofilter_settings';
    protected $id = 'storefront';

    public function getAllByStorefront($storefront)
    {
        return $this->query("SELECT * FROM `".$this->table."` WHERE `storefront` = s:storefront", array('storefront' => $storefront))->fetchAll();
    }

    public static function getCategoryByRoute($route)
    {
        $m_settings = new self();

        $sql = "SELECT c.id, c.name, c.depth FROM shop_category c LEFT JOIN shop_category_routes cr ON c.id = cr.category_id WHERE (cr.route IS NULL OR cr.route = '".$route."') ORDER BY c.left_key";
        return $m_settings->query($sql)->fetchAll();
    }

    public static function setSettings($settings)
    {
        $m_settings = new self();

        $storefronts = self::getStorefronts();

        foreach ($storefronts as $storefront) {

            if (isset($settings[$storefront])) {

                $setting = $settings[$storefront];
                $rows = array();

                foreach ($setting as $name => $value) {

                    $rows[] = array(
                        'storefront' => $storefront,
                        'name' => $name,
                        'value' => $value
                    );

                }

                $m_settings->deleteByField(array('storefront' => $storefront));
                $m_settings->multipleInsert($rows);
            }
        }
    }

    public static function getSeofilterSettings($storefront = null)
    {
        $m_settings = new self();

        $result = array();
        $storefronts = self::getStorefronts();

        foreach ($storefronts as $_storefront)
        {
            if (!is_null($storefront) and $storefront != $_storefront)
            {
                continue;
            }

            $result[$_storefront] = array();

            $settings = $m_settings->getAllByStorefront($_storefront);

            foreach ($settings as $setting)
            {
                $result[$_storefront][$setting['name']] = $setting['value'];
            }

            if (!is_null($storefront))
            {
                return $result[$_storefront];
            }
        }

        return $result;
    }

    public static function getGeneralSeofilterSettings()
    {
        return self::getSeofilterSettings(self::GENERAL_STOREFRONT);
    }

    public static function getStorefrontSeofilterSettings()
    {
        return self::getSeofilterSettings(self::getCurrentStorefront());
    }

    public static function getStorefronts()
    {
        $routing = wa()->getRouting();

        $storefronts = array(self::GENERAL_STOREFRONT);

        $domains = $routing->getByApp('shop');

        foreach ($domains as $domain => $domain_routes)
        {
            foreach ($domain_routes as $route)
            {
                $storefronts[] = $domain.'/'.$route['url'];
            }
        }

        return $storefronts;
    }

    public static function getCurrentStorefront()
    {
        $routing = wa()->getRouting();
        $domain = $routing->getDomain();
        $route = $routing->getRoute();
        $storefronts = self::getStorefronts();
        $currentRouteUrl = $domain.'/'.$route['url'];

        return in_array($currentRouteUrl, $storefronts) ? $currentRouteUrl : null;
    }
}
