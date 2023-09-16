<?php
namespace App\Helpers;
use Illuminate\Support\Str;
class Helper
{
    //vao file composer.json khai bao o autoload sau do chay cau lenh
    // composer dump-autoload

    public static function menu($menus,$parent_id=0,$char='')
    {
        //$char la ky tu de phan biet menu con va cha

        $html='';
        foreach ($menus as $key=>$menu)
        {
            if($menu->parent_id==$parent_id)
            {
                $html.='
                    <tr>
                        <td>'.$menu->id .'</td>
                      <td>'.$char . $menu->name .'</td>
                      <td>'.$menu->active .'</td>
                      <td>'.$menu->updated_at .'</td>
                      <td><a class="btn btn-primary btn-sm" href="/admin/menus/edit/'.$menu->id.'"><i class="fas fa-edit"> Sửa</i></></td>
                       <td><a class="btn btn-danger btn-sm" href="#" onclick="removeRow('.$menu->id.',\'/admin/menus/destroy\')"><i class="fas fa-trash"> Xóa</i></></td>
                     </tr>
                ';
                unset($menus[$key]);//xoa bot cai da lay ra roi cho nhe
                $html.=self::menu($menus,$menu->id,$char.'--');
            }
        }
        return $html;
    }
}
