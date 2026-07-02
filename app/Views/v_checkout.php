<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="row">
    <div class="col-lg-6">
    <div class="card shadow-sm border-0">
       <div class="card-header bg-white">
            <h5 class="card-title">Detail Pesanan</h5>
        </div>
        <div class="card-body">

        <div class="col-12">
            <?= form_label('Nama', 'nama', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'nama',
                'id'       => 'nama',
                'class'    => 'form-control',
                'value'    => session()->get('username'),
                'readonly' => true]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Alamat', 'alamat', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'  => 'alamat',
                'id'    => 'alamat',
                'class' => 'form-control']) ?>
        </div> 

        <div class="col-12"> 
            <?= form_label('Kelurahan', 'kelurahan', ['class' => 'form-label']) ?>
            <?= form_dropdown('kelurahan', [], '', ['id' => 'kelurahan', 'class' => 'form-control']) ?>
        </div>

        <div class="col-12"> 
            <?= form_label('Layanan', 'layanan', ['class' => 'form-label']) ?> 
            <?= form_dropdown('layanan', [], '', ['id' => 'layanan', 'class' => 'form-control']) ?>
        </div> <div class="col-12">
            <?= form_label('Ongkir', 'ongkir', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'     => 'ongkir',
                'id'       => 'ongkir',
                'class'    => 'form-control',
                'readonly' => true]) ?>
        </div>

        <div class="col-12">
            <?= form_label('Kode Kupon', 'kupon_code', ['class' => 'form-label']) ?>
            <?= form_input([
                'name'        => 'kupon_code',
                'id'          => 'kupon_code',
                'class'       => 'form-control',
                'placeholder' => 'Contoh: HEMAT20'
            ]) ?>
            <div class="form-text text-muted small mt-1">Tersedia: HEMAT20, HEMAT30, MEMBER25</div>
        </div>

        <div class="col-12">
            <?= form_submit(
                'submit',
                'Buat Pesanan',
            [
                'class'=>'btn btn-primary float-end'
            ]
        )
        ?>
        </div>

        <?= form_close() ?>
        </div>
    </div>
    </div> 
    
    <div class="col-lg-6">
    <div class="card shadow-sm border-0">
       <div class="card-header bg-white">
            <h5 class="card-title">Ringkasan Pesanan</h5>
        </div>
        <div class="card-body">
             <table class="table table-sm align-middle m-0" style="border-color: #f0f0f0;">
            <thead>
                <tr>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Sub Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                        if (!empty($items)) :
                            foreach ($items as $index => $item) :
                        ?>
                            <tr class="border-bottom">
                                <td class="py-3 text-secondary" style="max-width: 150px; font-size: 0.9rem;"><?= $item['name'] ?></td>
                                <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?= number_to_currency($item['price'], 'IDR') ?></td>
                                <td class="py-3 text-secondary" style="font-size: 0.9rem;"><?= $item['qty'] ?></td>
                                <td class="py-3 text-secondary text-end" style="font-size: 0.9rem;"><?= number_to_currency($item['price'] * $item['qty'], 'IDR') ?></td>
                            </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                        
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-muted small py-2">Subtotal</td>
                            <td id="subtotal" class="text-secondary text-end py-2">
                                <?= number_to_currency($total, 'IDR') ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class="text-danger small py-2">Diskon Kupon</td>
    
                            <td class="text-danger text-end py-2 fw-semibold" style="line-height: 1.2;">
                                <span id="diskon">- <?= number_to_currency(0, 'IDR') ?></span>
                                <span id="persen_diskon"></span></td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class="text-muted small py-2">PPN (12%)</td>
                            <td id="ppn" class="text-secondary text-end py-2">
                                <?= number_to_currency($ppn, 'IDR') ?>
                            </td>
                        </tr>

                        <tr class="border-bottom">
                            <td colspan="2"></td>
                            <td class="text-muted small py-2">Biaya Admin</td>
                            <td id="admin" class="text-secondary text-end py-2">
                                <?= number_to_currency($biaya_admin, 'IDR') ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class="text-success small py-2 fw-semibold" style="line-height: 1.2;">Subtotal<br><span class="text-success small py-2 fw-semibold" style="line-height: 1.2;">(+PPN+Admin-Kupon)</span></td>
                            <td id="subtotal_kalkulasi" class="text-end py-2 fw-bold">
                                <?= number_to_currency(($total + $ppn + $biaya_admin), 'IDR') ?>
                            </td>
                        </tr>

                        <tr>
                            <td colspan="2"></td>
                            <td class="py-3"><strong>Grand Total<br><span class="py-3">(incl. Ongkir)</span></strong></td>
                            <td class="text-end py-3 text-nowrap">
                                <strong>
                                    <span id="total">
                                        <?= number_to_currency($grand_total, 'IDR') ?>
                                    </span>
                                </strong>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function () {

    let subtotal = <?= $total ?>;
    let ppn = <?= $ppn ?>;
    let admin = <?= $biaya_admin ?>;
    let ongkir = 0;
    let diskon = 0;

    function formatRupiah(angka){
        return "IDR " + angka.toLocaleString("id-ID");
    }

    function hitungTotal(){

        let kupon = $("#kupon_code").val().toUpperCase();
        let teksPersen = "";

        if(kupon == "HEMAT20"){
            diskon = subtotal * 0.20;
            teksPersen = "<br><span class='text-danger' style='font-size: 0.75rem;'>(20%)</span>";
        }

        else if(kupon == "HEMAT30"){
            diskon = subtotal * 0.30;
            teksPersen = "<br><span class='text-danger' style='font-size: 0.75rem;'>(30%)</span>";
        }

        else if(kupon == "MEMBER25"){
            diskon = subtotal * 0.25;
            teksPersen = "<br><span class='text-danger' style='font-size: 0.75rem;'>(25%)</span>";
        }

        else{
            diskon = 0;
            teksPersen = "";
        }

        let subtotalKalkulasi = subtotal - diskon + ppn + admin;
        let grandTotal = subtotalKalkulasi + ongkir;

        $("#persen_diskon").html(teksPersen);
        $("#diskon").text("- " + formatRupiah(diskon));
        $("#ppn").text(formatRupiah(ppn));
        $("#admin").text(formatRupiah(admin));
        $("#subtotal_kalkulasi").text(formatRupiah(subtotalKalkulasi));
        $("#ongkir_text").text(formatRupiah(ongkir));

        $("#ongkir").val(ongkir);
        $("#total").text(formatRupiah(grandTotal));
    }

    hitungTotal();

    $("#kupon_code").on('input', function(){
        hitungTotal();
    });

    $('#kelurahan').select2({
        placeholder: 'Cari daerah tujuan',
        minimumInputLength: 3,
        ajax: {
            url: '<?= site_url('ajax/destinations') ?>',
            dataType: 'json',
            delay: 300,
            data: function(params){
                return {
                    q: params.term
                };
            },
            processResults: function(data){
                return data;
            },
            cache: true
        }
    });

    $("#kelurahan").change(function(){
        let id_kelurahan = $(this).val();

        $("#layanan").empty();

        $.ajax({
            url: "<?= site_url('ajax/costs') ?>",
            dataType: "json",
            data:{
                destination:id_kelurahan
            },
            success:function(data){

                data.forEach(function(item){

                    $("#layanan").append(
                        $("<option>",{
                            value:item.cost,
                            text:item.description+" ("+item.service+") : estimasi "+item.etd+" hari"
                        })
                    );
                });
            }
        });
    });

    $("#layanan").change(function(){
        ongkir = parseInt($(this).val()) || 0;
        hitungTotal();

    });
});
</script>
<?= $this->endSection() ?>