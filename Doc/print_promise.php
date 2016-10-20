<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap -->
  <link href="<?php echo base_url(); ?>/assets/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
  <link href="<?php echo base_url(); ?>/assets/print_style/style.css" rel="stylesheet" type="text/css">


</head>
<body>
  <?php
  function convert($number){
    $txtnum1 = array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
    $txtnum2 = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
    $number = str_replace(",","",$number);
    $number = str_replace(" ","",$number);
    $number = str_replace("บาท","",$number);
    $number = explode(".",$number);
    if(sizeof($number)>2){
      return 'ทศนิยมหลายตัวนะจ๊ะ';
      exit;
    }
    $strlen = strlen($number[0]);
    $convert = '';
    for($i=0;$i<$strlen;$i++){
      $n = substr($number[0], $i,1);
      if($n!=0){
        if($i==($strlen-1) AND $n==1){ $convert .= 'เอ็ด'; }
        elseif($i==($strlen-2) AND $n==2){  $convert .= 'ยี่'; }
        elseif($i==($strlen-2) AND $n==1){ $convert .= ''; }
        else{ $convert .= $txtnum1[$n]; }
        $convert .= $txtnum2[$strlen-$i-1];
      }
    }

    $convert .= 'บาท';
    if(@$number[1]=='0' OR @$number[1]=='00' OR
    @$number[1]==''){
      $convert .= 'ถ้วน';
    }else{
      $strlen = strlen($number[1]);
      for($i=0;$i<$strlen;$i++){
        $n = substr($number[1], $i,1);
        if($n!=0){
          if($i==($strlen-1) AND $n==1){$convert
            .= 'เอ็ด';}
            elseif($i==($strlen-2) AND
            $n==2){$convert .= 'ยี่';}
            elseif($i==($strlen-2) AND
            $n==1){$convert .= '';}
            else{ $convert .= $txtnum1[$n];}
            $convert .= $txtnum2[$strlen-$i-1];
          }
        }
        $convert .= 'สตางค์';
      }
      return $convert;
    }

    // echo "<pre>";
    // echo convert(123);
    // exit();
    ?>
    <page size="A4" >
      <div class="col-sm-12 text-center" style="margin-top: -50px;font-size: 22px;font-weight: bolder;color: #ccc;">~ 1 ~</div>
      <div class="col-sm-12">
        <h1 class="text-center"> สัญญาผ่อนออมทองคำ </h1>
        <div class="row">
          <div class="col-sm-8 col-xs-8">ประเภท <?php echo $promise[0]['promise_gold_type'] ?></div>
          <div class=" col-sm-offset-0 col-sm-4 col-md-offset-0 col-md-4 col-xs-offset-0 col-xs-4" >เลขที่สัญญา <?php echo $promise[0]['promise_number'] ?></div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xs-6">ตัวแทนขาย <?php echo $promise[0]['agent_name'] ?> รหัส <?php echo $promise[0]['agent_code'] ?></div>
          <!-- <div class="col-md-2 col-xs-2"></div> -->
          <div class="col-md-4  col-md-offset-2 col-xs-offset-2 col-xs-4">ทำที่ <?php echo $promise[0]['promise_location'] ?></div>
        </div>
        <div class="row">
          <div class="col-md-6 col-xs-6">ฝ่ายขายต้นสังกัด <?php echo $promise[0]['branch_name'] ?> รหัส <?php echo $promise[0]['branch_code'] ?></div>
          <!-- <div class="col-md-2 col-xs-2"></div> -->
          <div class="col-md-4  col-md-offset-2 col-xs-4 col-xs-offset-2">วันที่ <script type="text/javascript">

          var monthNames = [
            "มกราคม", "กุมภาพันธ์", "มีนาคม",
            "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
            "สิงหาคม", "กันยายน", "ตุลาคม",
            "พฤศจิกายน", "ธันวาคม"
          ];

          var date = new Date("<?php echo $promise[0]['promise_start_date'] ?>");
          // console.log(date);
          var day = date.getDate();
          var monthIndex = date.getMonth();
          var year = date.getFullYear();
          var th_year = year+543;

          console.log(day, monthNames[monthIndex], year);
          document.write(day + ' ' + monthNames[monthIndex] + ' ' + th_year);
          </script></div>
        </div>
        <div class="row p_body" id="" style="margin-top:20px">
          <div class="col-md-12" style="text-indent: 50px;">
            สัญญาฉบับนี้ทำขึ้นระหว่าง ห้างทองจินดาภรณ์เยาวราช ตั้งอยู่เลขที่ 17 หมู่ 6 ตำบลศรีสุทโธ
            อำเภอบ้านดุง จังหวัดอุดรธานี โดย............................................................................... ผู้มีอำนาจลงนามในสัญญา ต่อไปนี้ ในสัญญาฉบับนี้ เรียกว่า "ผู้ขาย" 
            กับ <?php echo @$promise[0]['customers_title'] ?><?php echo $promise[0]['customers_name'] ?> <?php echo $promise[0]['customers_sername'] ?>
            อายุ <?php echo $promise[0]['customers_age'] ?> ปี
            ถือ <?php echo $promise[0]['customers_card_type'] ?>
            เลขที่ <?php echo $promise[0]['customers_id_number'] ?>
            ออกโดย <?php echo $promise[0]['customers_card_officer'] ?>
            วันที่ออกบัตร <script type="text/javascript">

            var monthNames = [
              "มกราคม", "กุมภาพันธ์", "มีนาคม",
              "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
              "สิงหาคม", "กันยายน", "ตุลาคม",
              "พฤศจิกายน", "ธันวาคม"
            ];

            var date = new Date("<?php echo $promise[0]['customers_card_issue'] ?>");
            // console.log(date);
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            var th_year = year+543;

            console.log(day, monthNames[monthIndex], year);
            document.write(day + ' ' + monthNames[monthIndex] + ' ' + th_year);
            </script>
            วันหมดอายุ <script type="text/javascript">

            var monthNames = [
              "มกราคม", "กุมภาพันธ์", "มีนาคม",
              "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
              "สิงหาคม", "กันยายน", "ตุลาคม",
              "พฤศจิกายน", "ธันวาคม"
            ];

            var date = new Date("<?php echo $promise[0]['customers_card_exp'] ?>");
            // console.log(date);
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            var th_year = year+543;

            console.log(day, monthNames[monthIndex], year);
            document.write(day + ' ' + monthNames[monthIndex] + ' ' + th_year);
            </script>
            <?php
				$this->db->where('PROVINCE_ID',$promise[0]['customers_addr_province_send']);
            	$query_province = $this->db->get('provinces');
				$province_send = $query_province->result_array();
				
				$this->db->where('AMPHUR_ID',$promise[0]['customers_addr_district_send']);
            	$query_district = $this->db->get('amphures');
				$district_send = $query_district->result_array();
				
			?>
            
            อยู่บ้านเลขที่ <?php echo $promise[0]['customers_addr_home_no'] ?>
            หมู่ที่ <?php echo $promise[0]['customers_addr_village_no'] ?>
            ซอย <?php echo $promise[0]['customers_addr_alley'] ?>
            ถนน <?php echo $promise[0]['customers_addr_road'] ?>
            ตำบล/แขวง <?php echo $promise[0]['customers_addr_locality'] ?>
            อำเภอ/เขต <?php echo $promise[0]['AMPHUR_NAME'] ?>
            จังหวัด <?php echo $promise[0]['PROVINCE_NAME'] ?>
            ไปรษณีย์ <?php echo $promise[0]['customers_addr_zipcode'] ?>
            เบอร์โทร <?php echo $promise[0]['customers_phone'] ?>
            อีเมล์ <?php echo $promise[0]['customers_email'] ?>
            อาชีพ <?php echo $promise[0]['customers_career'] ?>
            ซึ่งต่อไปในสัญญาฉบับนี้จะเรียกว่า “ผู้ซื้อ”
            อีกฝ่ายหนึ่ง ทั้งสองฝ่ายได้ตกลงทำสัญญาโดยมีรายละเอียดดังต่อไปนี้
          </div>
          <div class="col-md-12">
            ข้อ 1. ผู้ซื้อตกลงซื้อและผู้ขายตกลงขายสินค้าประเภททองคำ  96.5 %
            น้ำหนัก <?php echo $promise[0]['promise_gold_weight_baht'].".".$promise[0]['promise_gold_weight_stang']." สตางค์/บาท" ?> <br/>
            หรือ <?php echo $promise[0]['promise_gold_weight_k'] ?> กรัม ต่อไปนี้ในสัญญาฉบับนี้เรียกว่า “สินค้า”
          </div>
          <div class="col-md-12">
            ข้อ 2.	ผู้ซื้อตกลงชำระราคาสินค้าตามข้อ 1.
            ให้แก่ผู้ขายเป็นจำนวนเงิน <?php echo number_format($promise[0]['promise_gold_price']+$promise[0]['promise_fee']+$promise[0]['promise_block_value'], 0, '.', ','); ?> บาท
            ส่วนลดจำนวน <?php echo number_format($promise[0]['promise_discount'], 0, '.', ','); ?> บาท
            เป็นเงินที่จะต้องจ่ายทั้งสิ้น <?php echo number_format($promise[0]['promise_gold_total_price'], 0, '.', ','); ?> บาท (<?php echo convert($promise[0]['promise_gold_total_price']); ?>)
            โดยชำระเป็นรายงวดเดือนทั้งสิ้น <?php echo $promise[0]['promise_period'] ?> งวด
            โดยจะชำระงวดที่ 1 (งวดเดือนแรก) จำนวน <?php echo number_format($promise[0]['priod_value'], 0, '.', ','); ?> บาท (<?php echo convert($promise[0]['priod_value']); ?>)<br/>
            และงวดที่ 2 ถึงงวดที่ 6 / งวดที่ 12  เดือนละ <?php echo number_format($promise[1]['priod_value'], 0, '.', ','); ?> บาท (<?php echo convert($promise[1]['priod_value']); ?>)
            รวมเป็นเงินทั้งสิ้น <?php echo number_format($promise[0]['promise_gold_total_price'], 0, '.', ','); ?> บาท (<?php echo convert($promise[0]['promise_gold_total_price']); ?>)
            โดยจะเริ่มชำระค่างวดครั้งแรกใน<script type="text/javascript">

            var monthNames = [
              "มกราคม", "กุมภาพันธ์", "มีนาคม",
              "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม",
              "สิงหาคม", "กันยายน", "ตุลาคม",
              "พฤศจิกายน", "ธันวาคม"
            ];

            var date = new Date("<?php echo $promise[0]['promise_start_date'] ?>");
            // console.log(date);
            var day = date.getDate();
            var monthIndex = date.getMonth();
            var year = date.getFullYear();
            var th_year = year+543;

            console.log(day, monthNames[monthIndex], year);
            document.write('วันที่ ' +day + ' เดือน ' + monthNames[monthIndex] + ' พ.ศ. ' + th_year);
            </script>
            และครั้งต่อไปในทุก ๆ วันที่ <?php echo date('d',strtotime($promise[0]['promise_start_date']))*1 ?> ของงวดเดือนนั้น ๆ จนแล้วเสร็จ
            </div>
            <div class="col-md-12">
              เมื่อผู้ซื้อชำระเงินในแต่ละงวดแล้ว ผู้ซื้อต้องส่งหลักฐานการชำระเงินให้แก่ผู้ขาย เพื่อผู้ขายจะได้ดำเนินการออกใบเสร็จรับเงินส่งไปให้ผู้ซื้อตามที่อยู่ เลขที่ <?php echo $promise[0]['customers_addr_home_no_send'] ?>
            หมู่ที่ <?php echo $promise[0]['customers_addr_village_no_send'] ?>
            ซอย <?php echo $promise[0]['customers_addr_alley_send'] ?>
            ถนน <?php echo $promise[0]['customers_addr_road_send'] ?>
            ตำบล/แขวง <?php echo $promise[0]['customers_addr_locality_send'] ?>
            อำเภอ/เขต <?php echo $district_send[0]['AMPHUR_NAME'] ?>
            จังหวัด <?php echo $province_send[0]['PROVINCE_NAME'] ?>
            ไปรษณีย์ <?php echo $promise[0]['customers_addr_zipcode_send'] ?>
              <!--<hr style="border-top: 2px solid #777;border-style: dotted;margin-top: 10px;margin-bottom: 10px;">-->
              <table>
                <tr>
                  <td colspan="2">ในการผ่อนสินค้าตามวรรคแรกนั้น ผู้ซื้อสามารถเลือกชำระเงินโดยวิธี</td>
                </tr>
                <tr>
                  <td colspan="2">1.	นำเงินสดมาชำระกับทางร้านโดยตรง</td>
                </tr>
                <tr>
                  <td colspan="2">2.	โอนเงินเข้าบัญชี ห้างทองจินดาภรณ์ เยาวราช  สาขาเซ็นทรัลพลาซ่าอุดรธานี</td>
                </tr>
                <tr>
                  <td style="width: 33%;"><span style="margin-left:20px !important"></span>** ธนาคารกสิกรไทย</td>
                  <td>เลขที่  013-3-34605-8</td>
                </tr>
                <tr>
                  <td><span style="margin-left:20px !important"></span>** ธนาคารกรุงไทย</td>
                  <td>เลขที่  443-0-64131-5</td>
                </tr>
                <tr>
                  <td><span style="margin-left:20px !important"></span>** ธนาคารไทยพาณิชย์</td>
                  <td>เลขที่  859-2-45758-3</td>
                </tr>
                <tr>
                  <td><span style="margin-left:20px !important"></span>** ธนาคารกรุงเทพ</td>
                  <td>เลขที่  616-7-16979-3</td>
                </tr>
              </table>
            </div>
            <div class="col-md-12">
              ข้อ 3. คู่สัญญาตกลงกันว่ากรรมสิทธิ์ทรัพย์สินในสินค้า ตามข้อ 1. จะยังไม่โอนไปที่ผู้ซื้อจนกว่าผู้ซื้อจะผ่อนชำระสินค้าจนครบถ้วนแล้วเสร็จตามที่ระบุไว้ในข้อ 2. </div>
            </div>
          </div>
        </page>


        <page size="A4" >
          <div class="col-sm-12 text-center" style="margin-top: -35px;font-size: 22px;font-weight: bolder;color: #ccc;">~ 2 ~</div>
          <div class="col-sm-12">
            <div class="row p_body">
              <div class="col-md-12">ข้อ 4. ผู้ขายตกลงส่งมอบสินค้าตามข้อ 1. ในวันที่ผู้ซื้อผ่อนชำระค่างวดครบถ้วนแล้วเสร็จตามสัญญาฉบับนี้ โดยผู้ซื้อจะเป็นผู้มารับสินค้าที่บริษัท/ห้างร้านที่ระบุไว้ในสัญญาฉบับนี้ </div>
              <div class="col-md-12">ข้อ 5. หากผู้ซื้อผิดนัดชำระเงินในงวดใดงวดหนึ่งแล้ว ผู้ขายตกลงผ่อนผันให้ผู้ซื้อชำระค่างวดออกไปอีกไม่เกิน 10 วัน นับจากวันที่ครบกำหนดชำระ หากพ้นกำหนดเวลาดังกล่าวที่ผ่อนผันแล้ว ผู้ขายสามารถบอกเลิกสัญญาโดยวาจาได้ทันทีโดยไม่ต้องแจ้งให้ทราบล่วงหน้า โดยผู้ขายตกลงคืนเงินให้แก่ผู้ซื้อที่ผ่อนชำระมาทั้งหมด ผู้ซื้อตกลงยินยอมชำระค่าธรรมเนียมตามอัตราค่าธรรมเนียมที่ผู้ขายกำหนด ทั้งทองแท่งและทองรูปพรรณ โดยผู้ซื้อตกลงยินยอมให้ผู้ขายหักค่าธรรมเนียมดังกล่าวจากเงินที่ผู้ซื้อชำระค่างวดไปแล้ว แล้วจึงนำเงินที่เหลือคืนแก่ผู้ซื้อ </div>

              <div class="col-md-12">ข้อ 6. ในกรณีที่ผู้ซื้อประสงค์จะยกเลิกสัญญาก่อนครบกำหนดชำระตามข้อ 2. ผู้ซื้อจะต้องมาทำหนังสือยกเลิก สัญญากับผู้ขายเป็นลายลักษณ์อักษร โดยจะต้องแจ้งให้ผู้ขายทราบก่อนล่วงหน้า 7 วันนับแต่วันที่ผู้ซื้อชำระเงินค่างวดครั้งสุดท้าย เมื่อผู้ซื้อและผู้ขายตกลงยินยอมคืนเงินให้ผู้ซื้อที่ผ่อนชำระมาทั้งหมด และผู้ซื้อตกลงยินยอมชำระค่าธรรมเนียมตามอัตตราค่าเนียมที่ผู้ขายกำหนด ทั้งทองแท่งและทองรูปพรรณ โดยผู้ซื้อตกลงยินยอมให้ผู้ขายหักค่าธรรมเนียมดังกล่าวจากเงินที่ผู้ซื้อชำระค่างวดไปแล้ว แล้วจึงนำเงินที่เหลือคืนแก่ผู้ซื้อ </div>
              <div class="col-md-12">ข้อ 7.	อัตราค่าธรรมเนียมในการยกเลิกสัญญา อัตราค่าธรรมเนียมนี้ใช้กับทองคำแท่งและทองรูปพรรณ</div>
              <div class="col-md-12 col-sm-offset-0 col-sm-12" style="padding:0px 50px;">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tbody>
                    <tr>
                      <td>ทองคำหนัก</td>
                      <td>10</td>
                      <td>บาท</td>
                      <td>ค่าธรรมเนียม</td>
                      <td class="text-right">12,000</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ทองคำหนัก</td>
                      <td>5</td>
                      <td>บาท</td>
                      <td>ค่าธรรมเนียม</td>
                      <td class="text-right">6,000</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ทองคำหนัก</td>
                      <td>1</td>
                      <td>บาท</td>
                      <td>ค่าธรรมเนียม</td>
                      <td class="text-right">1,200</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ทองคำหนัก</td>
                      <td>50</td>
                      <td>สตางค์</td>
                      <td>ค่าธรรมเนียม</td>
                      <td class="text-right">800</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td>ทองคำหนัก</td>
                      <td>25</td>
                      <td>สตางค์</td>
                      <td>ค่าธรรมเนียม</td>
                      <td class="text-right">500</td>
                      <td>บาท</td>
                    </tr>
                    <tr>
                      <td colspan="6">ทั้งนี้อัตราค่าธรรมเนียมจะขึ้นอยู่กับน้ำหนักของสินค้าที่ผู้ซื้อเลือกผ่อนชำระ</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-12">ข้อ 8.	ในกรณีที่สัญญาฉบับนี้ยังไม่ยกเลิก และผู้ซื้อต้องการกู้เงินในสัญญาที่ผ่อนสินค้าอยู่ ผู้ซื้อมีสิทธิ์กู้เงินจากผู้ขายได้ในอัตราวงเงินที่ผู้ขายกำหนด และผู้ซื้อยังจะต้องผ่อนสินค้าจนกว่าจะครบสัญญา ทั้งนี้คู่สัญญาจะต้องมาทำสัญญากู้ยืมกันอีกฉบับหนึ่ง อนึ่งผู้ขายขอสงวนสิทธิ์ในการพิจารณาการอนุมัติให้ผู้ซื้อกู้หรือไม่ก็ได้ ซึ่งเป็นดุลยพินิจของผู้ขายแต่เพียงฝ่ายเดียว โดยไม่ต้องแจ้งล่วงหน้า</div>
              <div class="col-md-12">ข้อ 9.	กรณีที่ผู้ซื้อได้ผ่อนชำระสินค้าครบถ้วนตามข้อ 2. แล้ว ผู้ซื้อมีสิทธิฝากสินค้ากับผู้ขาย โดยผู้ขายตกลงรับค่าฝากสินค้าในอัตรา 15 บาทต่อเดือน ต่อน้ำหนักทอง 10 บาท ทั้งนี้ผู้ขายขอสงวนสิทธิในการพิจารณาอนุมัติให้ผู้ซื้อฝากสินค้าหรือไม่ก็ได้ ซึ่งเป็นดุลยพินิจของผู้ขายแต่เพียงฝ่ายเดียว โดยไม่ต้องแจ้งล่วงหน้า</div>
              <div class="col-md-12">ข้อ 10. หากผู้ซื้อไม่สามารถมารับสินค้าได้ด้วยตนเอง โดยมีความประสงค์จะให้บุคคลภายนอกสัญญาฉบับนี้มารับสินค้าแทน ผู้ซื้อจะต้องทำหนังสือมอบอำนาจพร้อมติดอากรแสตมป์ตามที่กฎหมายกำหนด ทั้งนี้ผู้รับมอบอำนาจจะต้องมาทำหนังสือรับสินค้าแทนกับผู้ขายแล้วแนบใบมอบอำนาจเป็นหลักฐานในการรับสินค้าด้วย</div>
              <div class="col-md-12" style="text-indent: 98px !important;">หรือหากผู้ซื้อมีความประสงค์ให้ผู้ขายดำเนินการจัดส่งสินค้าไปให้ทางไปรษณีย์ลงทะเบียนแบบมีประกันสินค้าสูญหาย  ผู้ซื้อต้องทำหนังสือบอกกล่าวให้ผู้ขายทราบ  และผู้ซื้อเป็นผู้ออกค่าใช้จ่ายในการจัดส่งเอง</div>

            </div>
          </div>
        </page>



        <page size="A4" >
          <div class="col-sm-12 text-center" style="margin-top: -35px;font-size: 22px;font-weight: bolder;color: #ccc;">~ 3 ~</div>
          <div class="col-sm-12">
            <div class="row p_body">
              <div class="col-md-12">สัญญาฉบับนี้ถูกทำขึ้นเป็นสองฉบับ มีความถูกต้องตรงกัน คู่สัญญาทั้งสองฝ่ายได้อ่านและเข้าในดีแล้ว จึงลายมือชื่อไว้ต่อหน้าพยานเป็นสำคัญ และเก็บสัญญาไว้ฝ่ายละฉบับ </div>
            </div>
            <div class="row" style="margin-top:50px">
              <div class="col-md-5 col-xs-5 text-center">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tbody>
                    <tr>
                      <td>ลงชื่อ..........................................ผู้ซื้อ </td>
                    </tr>
                    <tr>
                      <td>( <?php echo @$promise[0]['customers_title'] ?><?php echo $promise[0]['customers_name']." ".$promise[0]['customers_sername']; ?> ) </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5 col-md-offset-2 col-xs-5 col-xs-offset-2 text-center">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tbody>
                    <tr>
                      <td>ลงชื่อ..........................................ผู้ขาย</td>
                    </tr>
                    <tr>
                      <td>(……………………………………) </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5 col-md-offset-0 col-xs-5 text-center" style="margin-top:50px">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tbody>
                    <tr>
                      <td>ลงชื่อ..........................................พยาน</td>
                    </tr>
                    <tr>
                      <td>(……………………………………) </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-5 col-md-offset-2 col-xs-5 col-xs-offset-2 text-center" style="margin-top:50px">
                <table width="100%" border="0" cellspacing="5" cellpadding="5">
                  <tbody>
                    <tr>
                      <td>ลงชื่อ.........................................พยาน</td>
                    </tr>
                    <tr>
                      <td>(……………………………………) </td>
                    </tr>
                  </tbody>
                </table>
              </div>

          </div>
          <div class="col-md-12" style="position: absolute;top: 300%;">
          <p style="padding: 5px; margin:0px; text-decoration: underline;">เอกสารประกอบ</p>
          <p style="padding: 5px; margin:0px;">1. สำเนาบัตรประชาชนผู้ซื้อ  2 ฉบับ</p>
          <p style="padding: 5px; margin:0px;">2. สัญญาผ่อนออมทองคำ  2  ฉบับ</p>
          </div>
        </div>

        </page>
      </body>
      </html>
