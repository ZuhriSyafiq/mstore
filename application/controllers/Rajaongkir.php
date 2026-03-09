<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rajaongkir extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
    }

    // ==============================
    // 1. GET PROVINSI (FREE API)
    // ==============================
    public function provinsi()
    {
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        echo "<option value=''>-- Pilih Provinsi --</option>";
        foreach ($data as $prov) {
            echo "<option value='" . $prov['name'] . "' id_provinsi='" . $prov['id'] . "'>" . $prov['name'] . "</option>";
        }
    }


    // ==============================
    // 2. GET KOTA (FREE API)
    // ==============================
    public function kota()
    {
        $id_provinsi = $this->input->post('id_provinsi');
        $url = "https://www.emsifa.com/api-wilayah-indonesia/api/regencies/$id_provinsi.json";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        echo "<option value=''>-- Pilih Kota --</option>";
        foreach ($data as $k) {
            echo "<option value='" . $k['name'] . "' id_kota='" . $k['id'] . "'>" . $k['name'] . "</option>";
        }
    }
    // ==============================
    // 3. LIST EKSPEDISI (MANUAL)
    // ==============================
    public function ekspedisi()
    {
        echo '<option value="">-- Pilih Ekspedisi --</option>';
        echo '<option value="jne">JNE</option>';
        echo '<option value="tiki">TIKI</option>';
        echo '<option value="pos">POS Indonesia</option>';
    }

    // ==============================
    // 4. SIMULASI ONGKIR GRATIS
    // ==============================
    public function paket()
    {
        $berat = $this->input->post('berat');
        $ekspedisi = $this->input->post('ekspedisi');

        // SIMULASI ONGKIR (GRATIS)
        $base = 10000; // ongkir awal
        $ongkir = $base + ($berat * 2); // contoh rumus

        echo "<option value='REG' ongkir='" . $ongkir . "' estimasi='3-5 Hari'>
                REG | Rp." . $ongkir . " | 3-5 Hari
              </option>";
    }
}
