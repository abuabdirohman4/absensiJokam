<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class presence_board_controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function presence($pengajian_event_id) {
        
        echo "
            <script
                src='https://code.jquery.com/jquery-3.4.1.min.js'
                integrity='sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo='
                crossorigin='anonymous'></script>      
            <script>
            function api() {
                if($('#name').val() == '')
                    $('#result').html('');

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    var json = JSON.parse(xhttp.responseText);
                    document.getElementById('result').innerHTML = '';
                    json.forEach(function(element) {

                        document.getElementById('result').innerHTML += '<li class=\'item\' id=\'' + element['id'] + '\'>' + element['nama'] + ' - ' + element['kelompok'] + ' - ' + element['desa'] + '</li>';
                    })
                    $('.item').click(function(e) {
                        var id = $(this).attr('id');

                        $.ajax({
                            method: 'GET',
                            url: '" . base_url() . "api/presence-peserta/' + id,
                            success: function(res) {
                                if(res == 'success') {
                                    $('#name').val('')
                                    document.getElementById('result').innerHTML = '';
                                }
                            }
                        })
                    })
                };
                xhttp.open('POST', '" . base_url() . "api/peserta/' + document.getElementById('name').value)
                xhttp.send();
            }
            

            </script>
            <h2>Absensi</h2>
            <dl>Nama:</dl>
            <dl><input type='text' id='name' onkeyup='api()'></dl>
            <dl><button type='button' id='presence'>Send</button></dl>
            <div id='result'>

            </div>

            <script>
                $(document).ready(function() {
                    $('#reg').click(function() {
                        var nama = $('#reg-nama').val()
                        var kelompok = $('#reg-kelompok').val()
                        var desa = $('#reg-desa').val()
                        $.ajax({
                            method: 'POST',
                            data: {data: {nama : nama, kelompok : kelompok, desa : desa}},
                            url: '" . base_url() . "api/reg-peserta/',
                            success: function(res) {
                                if(res == 'success') {
                                    alert('berhasil')
                                        $('#reg-nama').val('')
                                        $('#reg-kelompok').val('')
                                        $('#reg-desa').val('')
                                } else
                                    alert('gagal');
                            }
                        })
                    })
                })  
            </script>

            <h2>Registrasi</h2>
            <dl>Nama:</dl>
            <dl><input id='reg-nama'></dl>
            <dl>Kelompok</dl>
            <dl><input id='reg-kelompok'></dl>
            <dl>Desa:</dl>
            <dl><input id='reg-desa'></dl>
            <dl><button id='reg'>Daftar</button></dl>
        ";
    }

    public function get_peserta($name) {

        $this->db->select('p.id as id, p.nama as nama, m1.value as kelompok, m2.value as desa');
        $this->db->distinct();
        $this->db->like('p.nama', $name);
        $this->db->from('peserta p');
        $this->db->join('meta_value_peserta m1', 'm1.peserta_id = p.id AND m1.meta_index_peserta_id = "1"', 'inner');
        $this->db->join('meta_value_peserta m2', 'm2.peserta_id = p.id AND m2.meta_index_peserta_id = "2"', 'inner');
        $this->db->limit(10);
        $query = $this->db->get('peserta');

        echo json_encode($query->result());
    }

    public function presence_peserta($peserta_id) {

        $data = array(
            'pengajian_event_id' => 1,
            'peserta_id' => $peserta_id,
            'status' => 'hadir'
        );

        if($this->db->insert('presence', $data))
            echo 'success';
    }

    public function reg_peserta() {

        $data = $this->input->post('data');

        $this->db->insert('peserta', array('pengajian_title_id' => '1', 'nama' => $data['nama']));
        $peserta_id = $this->db->insert_id();

        $this->db->insert('meta_value_peserta', array('peserta_id' => $peserta_id, 'meta_index_peserta_id' => '1', 'value' => $data['kelompok']));
        $this->db->insert('meta_value_peserta', array('peserta_id' => $peserta_id, 'meta_index_peserta_id' => '2', 'value' => $data['desa']));

        $data = array(
            'pengajian_event_id' => 1,
            'peserta_id' => $peserta_id,
            'status' => 'hadir'
        );

        $this->db->insert('presence', $data);

        echo 'success';
    }   

}

/* End of file presence_board_controller.php */
