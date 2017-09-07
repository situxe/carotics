<?php

class shopYoucityPluginHelper 
{
	private $fhandleCIDR, $fhandleCities, $fSizeCIDR, $fsizeCities;

    /*
     * @param CIDRFile файл базы диапазонов IP (cidr_optim.txt)
     * @param CitiesFile файл базы городов (cities.txt)
     */
	public function __construct($CIDRFile = false, $CitiesFile = false)
	{
		if(!$CIDRFile)
		{
			$CIDRFile = wa()->getAppPath("/plugins/youcity/files/").'cidr_optim.txt';		
		}
		if(!$CitiesFile)
		{
			$CitiesFile = wa()->getAppPath("/plugins/youcity/files/").'cities.txt';			
		}
		$this->fhandleCIDR = fopen($CIDRFile, 'r') or die("Cannot open $CIDRFile");
		$this->fhandleCities = fopen($CitiesFile, 'r') or die("Cannot open $CitiesFile");
		$this->fSizeCIDR = filesize($CIDRFile);
		$this->fsizeCities = filesize($CitiesFile);
	}

    /*
     * @brief Получение информации о городе по индексу
     * @param idx индекс города
     * @return массив или false, если не найдено
     */
	private function getCityByIdx($idx)
	{
		rewind($this->fhandleCities);
		while(!feof($this->fhandleCities))
		{
			$str = fgets($this->fhandleCities);
			$arRecord = explode("\t", trim($str));
			if($arRecord[0] == $idx)
			{
				return array(	'city' => $arRecord[1],
								'region' => $arRecord[2],
								'district' => $arRecord[3],
								'lat' => $arRecord[4],
								'lng' => $arRecord[5]);
			}
		}
		return false;
	}
    
    public function getCitySearch($query)
	{
		rewind($this->fhandleCities);
		while(!feof($this->fhandleCities))
		{
			$str = fgets($this->fhandleCities);
            $arRecord = explode("\t", trim($str));
            $pos = strpos(strtolower($arRecord[1]),strtolower($query));
            if($pos === false)
            {}
            else
            {  
                $result[$arRecord[0]] = $arRecord;
            }	
		}
		return $result;
	}

    /*
     * @brief Получение гео-информации по IP
     * @param ip IPv4-адрес
     * @return массив или false, если не найдено
     */
	public function getRecord($ip)
	{
		$ip = sprintf('%u', ip2long($ip));
		
		rewind($this->fhandleCIDR);
		$rad = floor($this->fSizeCIDR / 2);
		$pos = $rad;
		while(fseek($this->fhandleCIDR, $pos, SEEK_SET) != -1)			
		{
			if($rad) 
			{
				$str = fgets($this->fhandleCIDR);				
			}
			else
			{
				rewind($this->fhandleCIDR);
			}
			
			$str = fgets($this->fhandleCIDR);
			
			if(!$str)
			{
				return false;
			}
			
			$arRecord = explode("\t", trim($str));
               
			$rad = floor($rad / 2);
			if(!$rad && ($ip < $arRecord[0] || $ip > $arRecord[1]))
			{
				return false;
			}
			
			if($ip < $arRecord[0])
			{
				$pos -= $rad;
			}
			elseif($ip > $arRecord[1])
			{
				$pos += $rad;
			}
			else
			{
				$result = array('range' => $arRecord[2], 'cc' => $arRecord[3]);
											
				if($arRecord[4] != '-' && $cityResult = $this->getCityByIdx($arRecord[4]))
				{
					$result += $cityResult;
				}
				
				return $result;
			}
		}
		return false;		
	}
}

