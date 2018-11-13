<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DedicacionHoras extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'dedicacion_horas';

    /**
     * @var array
     */
    protected $fillable = ['id_tarea', 'dia', 'horas', 'created_at', 'updated_at'];

    public static function jsonToDebug($jsonText = '')
    {
        $arr = json_decode($jsonText, true);
        $html = "";
        if ($arr && is_array($arr)) {
            $html .= self::_arrayToHtmlTableRecursive($arr);
        }
        return $html;
    }

    private static function _arrayToHtmlTableRecursive($arr) {
        $str = "<table class='table table_modal display compact' cellspacing='0' width='100%'>
        <thead>
                        <tr>
                            <td>id</td>
                            <td>id_tarea</td>
                            <td>dia</td>
                            <td>horas</td>
                            <td>created_at</td>
                            <td>updated_at</td>
                            </tr>
        <tbody>";
        foreach ($arr as $k => $val) {
            $str .= "<tr>";
            foreach ($val as $key => $v) {

                $str .= "<td>".$v."</td>";



            }
            $str .= "</tr>";
        }
        $str .= "</tbody></table>";

        return $str;
    }
}
