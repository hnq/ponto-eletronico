<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PointReportController extends Controller
{
    public function index(Request $request)
    {
        // Filtragem por datas, recebida via query string, ou defaults
        $startDate = $request->input('start_date', '2000-01-01');
        $endDate = $request->input('end_date', date('Y-m-d'));

        // SQL puro com binds para evitar SQL injection
        $records = DB::select(
            "
            SELECT
                p.id AS registro_id,
                u.name AS funcionario_nome,
                u.position AS cargo,
                TIMESTAMPDIFF(YEAR, u.birth_date, CURDATE()) AS idade,
                m.name AS gestor_nome,
                DATE_FORMAT(p.registered_at, '%Y-%m-%d %H:%i:%s') AS data_hora_registro
            FROM points p
            JOIN users u ON p.user_id = u.id
            LEFT JOIN users m ON u.manager_id = m.id
            WHERE p.registered_at BETWEEN ? AND ?
            ORDER BY p.registered_at DESC
            ",
            [$startDate, $endDate . ' 23:59:59']
        );

        // Retornar para uma view simples com Blade ou JSON para teste
        return view('points.report', compact('records', 'startDate', 'endDate'));
    }
}
