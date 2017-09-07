<?php

class shopSeofilterSettingsFieldsModel extends waModel
{
	protected $table = 'shop_seofilter_settings_fields';

    public static function getAllFields()
	{
		$m_settings = new self();

		$rows = $m_settings->getAll();
		$fields = array();

		foreach ($rows as $row)
		{
			$fields[$row['id']] = $row['name'];
		}

		return $fields;
	}

    public function updateFields($fields)
	{
		$rows = array();

		foreach ($fields as $id => $name)
		{
			$rows[] = array(
				'id' => $id,
				'name' => $name,
			);
		}

		return $this->query('DELETE FROM `'.$this->table.'`')
			and $this->multipleInsert($rows);
	}

	public function addFields($fields)
	{
		$rows = array();

		foreach ($fields as $name)
		{
			if ($name) {
				$rows[] = array(
					'id' => null,
					'name' => $name,
				);
			}
		}

		return $this->multipleInsert($rows);
	}
}
