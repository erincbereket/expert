<html>
<div class="well">
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Adı</th>
          <th>Soyadı</th>
          <th>Profil</th>
          <th style="width: 36px;"></th>
        </tr>
      </thead>
      <tbody>
             
        <h1>ARAMA SONUCU :</h1>  
          
    <?php
	
    $a_kategori=$_POST['kategori'];
      
    //kategoriyi belirleme
    if($a_kategori=='Uzman'){
	$total = count($results_expert);
     	if($total == 0)  
        {  
            echo '<p>Kayıt Bulunamadı.</p>';  
        }
        else{
	for($i=0; $i<$total; $i++)  
            {  
                echo '<p>'. $results_expert[$i]->name .'</p>';  
            } 
        }
	}

    if($a_kategori=='Alan'){
	$total = count($results_professions);
        //bir kategoriye göre verilerin alýnýp, listelenmesi
	if($total == 0)  
        {  
            echo '<p>Kayıt Bulunamadı.</p>';  
        }
	else{
        for($i=0; $i<$total; $i++)  
            {  
		  
		$sira = '<p>'.$i.'</p>';
		$adi = '<p>'. $results_professions[$i]->name .'</p>';
		$soyadi = '<p>'.$results_professions[$i]->surname.'</p>';
		$profili = '<p>'.$results_professions[$i]->surname.'</p>';
		echo "<tr>";
		echo "<td> $sira </td>";
		echo "<td> $adi </td>";
		echo "<td> $soyadi </td>";
		echo "<td> $profili </td>";
		echo "</tr>";
            }  
        }
	
    }

 
// Veritabaný baðlantýsý sonlandýrma
mysql_close();
?>

      </tbody>
    </table>
</div>
<div class="pagination">
    <ul>
        <li><a href="#">Prev</a></li>
        <li><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">Next</a></li>
    </ul>
</div>

