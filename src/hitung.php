<?php
    error_reporting(0);
    $ukt  = $_POST['ukt'];
    $ipk = $_POST['ipk'];
    
    if ($ukt < 0 || $ipk < 3 || $ipk > 4 )  {
      $z="";
      echo "Maaf, data yang Anda masukkan tidak sesuai dengan rentang yang ditentukan!";
    }else {
    //UKT Murah
      if($ukt<=1000000){
        $uktmurah = 1;
      }
      else if($ukt>1000000 && $ukt<3000000){
        $uktmurah = (3000000-$ukt)/(3000000-1000000);
      }
      else if($ukt>=3000000){
        $uktmurah = 0;
      }
    //UKT Sedang
      if($ukt<=1000000){
        $uktsedang = 0;
      }
      else if($ukt>=5000000){
          $uktsedang = 0;
      }
      else if($ukt>1000000 && $ukt<3000000){
        $uktsedang = ($ukt-1000000)/(3000000-1000000);
      }
      else if ($ukt>3000000 && $ukt<5000000){
        $uktsedang=(5000000-$ukt)/(5000000-3000000);
      }
      else if($ukt==3000000){
        $uktsedang=1;
      }
    //UKT Mahal
      if($ukt<=3000000){
        $uktmahal = 0;
      }
      else if($ukt>3000000 && $ukt<5000000){
        $uktmahal=($ukt-3000000)/(5000000-3000000);
      }
      else if($ukt>=5000000){
        $uktmahal = 1;
      }

    //IPK Baik
      if($ipk<=3.2){
        $ipkbaik = 1;
      }
      else if($ipk>3.2 && $ipk<3.8){
        $ipkbaik = (3.8-$ipk)/(3.8-3.2);

      }
      else if($ipk>=3.8){
        $ipkbaik = 0;
      }
    //IPK Sangat Baik
      if($ipk<=3.2){
         $ipksangatbaik = 0;
      }
      else if($ipk>3.2 && $ipk<3.8){
        $ipksangatbaik= ($ipk-3.2)/(3.8-3.2);
      }
      else if($ipk>=3.8){
        $ipksangatbaik = 1;
      }


      $z1= 0;
      $z2= 0;
      $z3= 0;
      $z4= 0;
      $z5= 0;
      $z6= 0;
    
      $a1=min($uktmurah,$ipkbaik); //maka beasiswa kecil
      $z1 = 5000000 - $a1 * (5000000-3000000);

      $a2=min($uktmurah,$ipksangatbaik); //maka beasiswa kecil
      $z2 = 5000000 - $a2 * (5000000-3000000);

      $a3=min($uktsedang,$ipkbaik); //maka beasiswa kecil
      $z3 = 5000000 - $a3 * (5000000-3000000);

      $a4=min($uktsedang,$ipksangatbaik); //maka beasiswa besar
      $z4 = $a4 * (5000000-3000000) + 3000000;

      $a5=min($uktmahal,$ipkbaik); //maka beasiswa besar
      $z5 = $a5 * (5000000-3000000) + 3000000;

      $a6=min($uktmahal,$ipksangatbaik); //maka beasiswa besar
      $z6 = $a6 * (5000000-3000000) + 3000000;

      $total_AiZi = ($a1*$z1)+($a2*$z2)+($a3*$z3)+($a4*$z4)+($a5*$z5)+($a6*$z6);
      $total_a = $a1+$a2+$a3+$a4+$a5+$a6;
      $z = $total_AiZi/$total_a;

      $beasiswa = $z;

    //Beasiswa Kecil
      if($beasiswa==3000000){
        $beasiswakecil = 1;
      }
      else if($beasiswa>3000000 && $beasiswa<5000000){
        $beasiswakecil=(5000000-$beasiswa)/(5000000-3000000);
      }
      else if($beasiswa==5000000){
        $beasiswakecil = 0;
      }

    //Beasiswa Besar
      if($beasiswa==3000000){
        $beasiswabesar = 0;
      }
      else if($beasiswa>3000000 && $beasiswa<5000000){
        $beasiswabesar=($beasiswa-3000000)/(5000000-3000000);
      }
      else if($beasiswa==5000000){
        $beasiswabesar = 1;
      }

    }
?>

<?php
if($z!=""){
?>
  <div class="row">
    <div class="col-md-12">
      <table class="table-striped table-hasil">
        <tr style="background-color:CadetBlue; color:white;">
          <td align="center">Variabel</td>
          <td align="center">Nilai</td>
          <td align="center" width="50%">Derajat Keanggotaan</td>
        </tr>
        <tr>
          <td align="center" valign="middle" class="pt10">UKT</td>
          <td align="center" valign="middle" class="pt10">Rp <?php echo number_format($ukt,2,",",".");?></td>
          <td align="center" valign="middle">
            <center><?php displayukt($uktmurah, $uktsedang, $uktmahal);?></center>
          </td>
        </tr>
        <tr>
          <td align="center" valign="middle" class="pt10">IPK</td>
          <td align="center" valign="middle" class="pt10"><?php echo number_format($ipk,2,",",".");?></td>
          <td align="center" valign="middle">
            <center><?php displayipk($ipkbaik, $ipksangatbaik);?></center>
          </td>
        </tr>
        <tr>
          <td align="center" valign="middle" class="pt10">Perolehan Beasiswa</td>
          <td align="center" valign="middle" class="pt10">Rp <?php echo number_format($beasiswa,2,",",".");?></td>
          <td align="center" valign="middle">
            <center><?php displaybeasiswa($beasiswakecil, $beasiswabesar);?></center>
          </td>
        </tr>
        <tr style="background-color:white;">
          <td colspan=3 style="border-top: 3.5px solid #413c3c; padding-top: 8px;">
          </td>
        </tr>
      </table>
      <hr>
      <table class="table-striped table-rumus">
          <tr style="background-color:CadetBlue; color:white;">
            <td align="center" style="width:45px;">Rule</td>
            <td align="center">Kondisi</td>
            <td align="center">Derajat<br>UKT</td>
            <td align="center">Derajat<br>IPK</td>
            <td align="center">Alpha<br>(αi)</td>
            <td align="center">Zi</td>
            <td align="center">αi×Zi</td>
          </tr>
          <tr>
            <td><center>R1<center></td>
            <td>Jika UKT <b>Murah</b> dan IPK <b>Baik</b> Maka Beasiswa <b>Kecil</b></td>
            <td><center><?php echo round($uktmurah,2);?><center></td>
            <td><center><?php echo round($ipkbaik,2);?><center></td>
            <td><center><?php echo round($a1,2);?><center></td>
            <td><center><?php echo round($z1,2);?><center></td>
            <td><center><?php echo round($a1*$z1,2);?><center></td>
          </tr>
          <tr>
            <td><center>R2<center></td>
            <td>Jika UKT <b>Murah</b> dan IPK <b>Sangat Baik</b> Maka Beasiswa <b>Kecil</b></td>
            <td><center><?php echo round($uktmurah,2);?><center></td>
            <td><center><?php echo round($ipksangatbaik,2);?><center></td>
            <td><center><?php echo round($a2,2);?><center></td>
            <td><center><?php echo round($z2,2);?><center></td>
            <td><center><?php echo round($a2*$z2,2);?><center></td>
          </tr>
          <tr>
            <td><center>R3<center></td>
            <td>Jika UKT <b>Sedang</b> dan IPK <b>Baik</b> Maka Beasiswa <b>Kecil</b></td>
            <td><center><?php echo round($uktsedang,2);?><center></td>
            <td><center><?php echo round($ipkbaik,2);?><center></td>
            <td><center><?php echo round($a3,2);?><center></td>
            <td><center><?php echo round($z3,2);?><center></td>
            <td><center><?php echo round($a3*$z3,2);?><center></td>
          </tr>
          <tr>
            <td><center>R4<center></td>
            <td>Jika UKT <b>Sedang</b> dan IPK <b>Sangat Baik</b> Maka Beasiswa <b>Besar</b></td>
            <td><center><?php echo round($uktsedang,2);?><center></td>
            <td><center><?php echo round($ipksangatbaik,2);?><center></td>
            <td><center><?php echo round($a4,2);?><center></td>
            <td><center><?php echo round($z4,2);?><center></td>
            <td><center><?php echo round($a4*$z4,2);?><center></td>
          </tr>
          <tr>
            <td><center>R5<center></td>
            <td>Jika UKT <b>Mahal</b> dan IPK <b>Baik</b> Maka Beasiswa <b>Besar</b></td>
            <td><center><?php echo round($uktmahal,2);?><center></td>
            <td><center><?php echo round($ipkbaik,2);?><center></td>
            <td><center><?php echo round($a5,2);?><center></td>
            <td><center><?php echo round($z5,2);?><center></td>
            <td><center><?php echo round($a5*$z5,2);?><center></td>
          </tr>
          <tr>
            <td><center>R6<center></td>
            <td>Jika UKT <b>Mahal</b> dan IPK <b>Sangat Baik</b> Maka Beasiswa <b>Besar</b></td>
            <td><center><?php echo round($uktmahal,2);?><center></td>
            <td><center><?php echo round($ipksangatbaik,2);?><center></td>
            <td><center><?php echo round($a6,2);?><center></td>
            <td><center><?php echo round($z6,2);?><center></td>
            <td><center><?php echo round($a6*$z6,2);?><center></td>
          </tr>
          <tr style="background-color: #5f9ea032;">
            <td></td>
            <td><b>Jumlah</b></td>
            <td><center><b>-</b><center></td>
            <td><center><b>-</b><center></td>
            <td><center><b><?php echo round($total_a,3);?></b><center></td>
            <td><center><b>-</b><center></td>
            <td><center><b><?php echo round($total_AiZi,2);?></b><center></td>
          </tr>
          <tr style="border-top: 3.5px solid #413c3c; padding-top: 8px; background-color:white;">
            <td></td>
            <td colspan="6"><b>Perolehan Beasiswa</b> = ∑(αi×Zi) / ∑(αi) = <?php echo round($total_AiZi,2)." / ".round($total_a,3);?> = <b>Rp <?php echo number_format($beasiswa,2,",",".");?></b></td>
          </tr>
      </table>
    </div>
  </div>
<?php
}
?>

<?php 
function displayukt($uktmurah, $uktsedang, $uktmahal){

  $uktmurah = round($uktmurah,2);
  $uktsedang = round($uktsedang,2);
  $uktmahal = round($uktmahal,2);

  if ($uktmurah==0){
      echo "<button class='nol' disabled><small>Murah</small> (0)</button>";
  }else{
      echo "<button class='rendah' disabled><small>Murah</small> (".$uktmurah.")</button>";
  }
  if ($uktsedang!=0){
      echo "<button class='sedang' disabled><small>Sedang</small> (".$uktsedang.")</button>";
  }else{
      echo "<button class='nol' disabled><small>Sedang</small> (0)</button>";
  }
  if ($uktmahal!=0){
      echo "<button class='tinggi' disabled><small>Mahal</small> (".$uktmahal.")</button>";
  }else{
      echo "<button class='nol' disabled><small>Mahal</small> (0)</button>";
  }


}
?>

<?php 
function displayipk($ipkbaik, $ipksangatbaik){

  $ipkbaik = round($ipkbaik,2);
  $ipksangatbaik = round($ipksangatbaik,2);

  if ($ipkbaik==0){
      echo "<button class='nol' disabled><small>Baik</small> (0)</button>";
  }else{
      echo "<button class='rendah' disabled><small>Baik</small> (".$ipkbaik.")</button>";
  }
  if ($ipksangatbaik!=0){
      echo "<button class='tinggi' disabled><small>Sangat Baik</small> (".$ipksangatbaik.")</button>";
  }else{
      echo "<button class='nol' disabled><small>Sangat Baik</small> (0)</button>";
  }
}
?>

<?php 
function displaybeasiswa($beasiswakecil, $beasiswabesar){

  $beasiswakecil = round($beasiswakecil,2);
  $beasiswabesar = round($beasiswabesar,2);
  
  if ( $beasiswakecil==0){
      echo "<button class='nol' disabled><small>Kecil</small> (0)</button>";
  }else{
      echo "<button class='rendah' disabled><small>Kecil</small> (".$beasiswakecil.")</button>";
  }
  if ($beasiswabesar!=0){
      echo "<button class='tinggi' disabled><small>Besar</small> (".$beasiswabesar.")</button>";
  }else{
      echo "<button class='nol' disabled><small>Besar</small> (0)</button>";
  }
}
?>