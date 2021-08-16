<?php

namespace App\Models;

use CodeIgniter\Model;

class M_formalat extends Model
{
    protected $table = 'tblt_peralatan';
    protected $primaryKey = 'tahananId';
    protected $allowedFields = ['tahananId', 'kejaksaanId', 'polsekId', 'fullName', 'pob', 'dob', 'gender', 'country', 'address', 'job', 'study', 'coupleName', 'father', 'mother', 'noKeputusanMentri', 'amarPutusan', 'dateStartPidana', 'tglNoSuratKeputusan', 'syaratPembinaan', 'tanggalLepasBersyarat', 'tanggalPelaksanaanLepasBersyarat', 'dateEndMasaPercobaan', 'bispa', 'description', 'jaksaUtama', 'photo', 'statusTahanan', 'tanggalBebas', 'deletedAt'];
    protected $useSoftDeletes = true;
    protected $deletedField = 'deletedAt';
    protected $column_order = ['tanggalLepasBersyarat', 'fullname', 'gender', 'Polsek', 'statusTahanan', null]; //set column field database for datatable orderable
    protected $column_search = ['tanggalLepasBersyarat', 'fullname', 'gender', 'Polsek', 'statusTahanan']; //set column field database for datatable searchable just firstname , lastname , address are searchable
    protected $order = array('createdAt' => 'desc'); // default order 

    private function _get_datatables_query()
    {
        $queryDT = $this->builder("vw_tahahan");
        $i = 0;
        foreach ($this->column_search as $item) // loop column 
        {
            if ($_POST['search']['value']) // if datatable send POST for search
            {
                if ($i === 0) // first loop
                {
                    $queryDT = $queryDT->groupStart(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $queryDT = $queryDT->like($item, $_POST['search']['value']);
                } else {
                    $queryDT = $queryDT->orLike($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $queryDT = $queryDT->groupEnd(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) // here order processing
        {
            $queryDT = $queryDT->orderBy($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order1 = $this->order;
            $queryDT = $queryDT->orderBy(key($order1), $order1[key($order1)]);
        }

        return $queryDT;
    }

    function get_datatables($deleted = 0, $dateFrom = "", $dateTo = "")
    {
        $query = $this->_get_datatables_query();

        if ($dateFrom != "" & $dateTo != "") {
            $query = $query->where("(DATE(tanggalLepasBersyarat) BETWEEN DATE('" . $dateFrom . "') AND DATE('" . $dateTo . "'))");
        }
        return $query->where("deletedAt IS " . ($deleted == 1 ? "NOT " : "") .  "NULL", null, false)->limit($_POST['length'], $_POST['start'])->get()->getResult();
    }

    function count_filtered($deleted = 0, $dateFrom = "", $dateTo = "")
    {
        $query = $this->_get_datatables_query();

        if ($dateFrom != "" & $dateTo != "") {
            $query = $query->where("(DATE(tanggalLepasBersyarat) BETWEEN DATE('" . $dateFrom . "') AND DATE('" . $dateTo . "'))");
        }
        return $query->where("deletedAt IS " . ($deleted == 1 ? "NOT " : "") .  "NULL", null, false)->countAll();
    }

    public function count_all($deleted = 0, $dateFrom = "", $dateTo = "")
    {
        $query = $this->builder("vw_tahahan")->where("deletedAt IS " . ($deleted == 1 ? "NOT " : "") .  "NULL", null, false);
        if ($dateFrom != "" & $dateTo != "") {
            $query = $query->where("(DATE(tanggalLepasBersyarat) BETWEEN DATE('" . $dateFrom . "') AND DATE('" . $dateTo . "'))");
        }

        return $query->countAll();
    }

    public function getById(string $id)
    {
        $result = $this->builder()->getWhere([
            $this->primaryKey => $id
        ])->getFirstRow();

        return $result;
    }

    public function getAll()
    {
        $builder = $this->builder();
        $res = $builder->where('deletedAt IS NULL', NULL)->get();

        return $res->getResult();
    }

    public function getActiveAll()
    {
        $builder = $this->builder();
        $res = $builder->where("statusTahanan = 'Bebas Bersyarat' AND deletedAt IS NULL", NULL)->get();

        return $res->getResult();
    }

    public function createTahanan($data)
    {
        return $this->builder()->insert($data);
    }

    public function updateTahanan($id, $data)
    {
        $this->builder()->where($this->primaryKey, $id)->update($data);
        return true;
    }

    public function deletePermanent($id)
    {
        $this->builder()->where($this->primaryKey, $id)->delete();
        return true;
    }
}
