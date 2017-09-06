<?php
    /*三种图片格式缩放*/
    $a = './images/3.jpg';
    zipPic($a);
    
    function zipPic($picName)
    {
    //1.创建画布
       $ext = pathinfo($picName,PATHINFO_EXTENSION);  //获得扩展名
       $fName = pathinfo($picName,PATHINFO_FILENAME);  //获得原来的文件名
       
         if($ext=='jpg'){
            $ext = 'jpeg';
         }
       
         
        $funName =  'imagecreatefrom'.$ext; // 拼装函数的名字
        $hSrc = $funName($picName);  //创建图片画布
      
        $w = imagesX($hSrc);  //获得图片 宽
        $h = imagesY($hSrc);  //获得图片 高
      
      
         $width=100;   //新图宽
         $height=100;  //新图高
      
         $hDst = imagecreatetruecolor($width,$height); //创建100x100的新画布
      
          //解决png图黑背景问题
          $color = imagecolorallocate($hDst,255,255,255); //分配颜色 
          imagecolortransparent($hDst,$color);     //把这个颜色设置透明色
          imagefill($hDst,0,0,$color);    //用颜色填充新画布
      
    //2.复制
       imagecopyresampled($hDst,$hSrc,0,0,0,0,$width,$height,$w,$h);

    //3.输出
       header("Content-type:image/{$ext}");

       $outName = 'image'.$ext; //拼接 输出函数的函数名字
       // $outName($hDst,"./sm_{$fName}.{$ext}");
      
       
    //4.销毁    
       imagedestroy($hDst);
       imagedestroy($hSrc);
    }
    
    
?>