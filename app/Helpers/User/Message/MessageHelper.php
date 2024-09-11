<?php
namespace App\Helpers\Message;

use App\Helpers\Venturo;
use App\Models\MessageModel;
use Illuminate\Support\Facades\Hash;
use Throwable;

/**
 * Helper untuk manajemen Message
 * Mengambil data, menambah, mengubah, & menghapus ke tabel m_Message
 *
 * @author Wahyu Agung <wahyuagung26@gmail.com>
 */
class MessageHelper extends Venturo
{

    private $MessageModel;

    public function __construct()
    {
        $this->MessageModel = new MessageModel();
    }

    /**
     * method untuk menginput data baru ke tabel m_Message
     *
     * @author Wahyu Agung <wahyuagung26@email.com>
     *
     * @param array $payload
     *                       $payload['name'] = string
     *                       $payload['email] = string
     *                       $payload['password] = string
     *
     * @return array
     */
    public function create(array $payload): array
    {
        try {
            $payload['password'] = Hash::make($payload['password']);

            // $payload = $this->uploadGetPayload($payload);
            $Message = $this->MessageModel->store($payload);

            return [
                'status' => true,
                'data' => $Message
            ];
        } catch (Throwable $th) {
            return [
                'status' => false,
                'error' => $th->getMessage()
            ];
        }
    }

    /**
     * Menghapus data Message dengan sistem "Soft Delete"
     * yaitu mengisi kolom deleted_at agar data tsb tidak
     * keselect waktu menggunakan Query
     *
     * @param integer $id id dari tabel m_Message
     *
     * @return bool
     */
    public function delete(string $id): bool
    {
        try {
            $this->MessageModel->drop($id);

            return true;
        } catch (Throwable $th) {
            return false;
        }
    }

    /**
     * Mengambil data Message dari tabel m_Message
     *
     * @author Wahyu Agung <wahyuagung26@gmail.com>
     *
     * @param array $filter
     *                      $filter['name'] = string
     *                      $filter['email'] = string
     * @param integer $itemPerPage jumlah data yang ditampilkan, kosongi jika ingin menampilkan semua data
     * @param string $sort nama kolom untuk melakukan sorting mysql beserta tipenya DESC / ASC
     *
     * @return array
     */
    public function getAll(array $filter, int $itemPerPage = 0, string $sort = '')
    {
        $Messages = $this->MessageModel->getAll($filter, $itemPerPage, $sort);

        return [
            'status' => true,
            'data' => $Messages
        ];
    }

    /**
     * Mengambil 1 data Message dari tabel m_Message
     *
     * @param integer $id id dari tabel m_Message
     *
     * @return array
     */
    public function getById(string $id): array
    {
        $Message = $this->MessageModel->getById($id);
        if (empty($Message)) {
            return [
                'status' => false,
                'data' => null
            ];
        }

        return [
            'status' => true,
            'data' => $Message
        ];
    }


}
