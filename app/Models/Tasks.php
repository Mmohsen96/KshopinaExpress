<?php

namespace App\Models;
use DateTime;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tasks extends Model
{
    use HasFactory;

    public function get_users(){
        return DB::select('select * from users where team = ?', [1]);
    }
    //yasmin and nour
    public function get_tasks($rule, $page, $user)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        if ($rule == 'All') {
            $orders = DB::select('SELECT tasks.order_number,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name,tasks.id,tasks.comment,tasks.deadline,
            tasks.priority,tasks.solved,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id
            WHERE tasks.status < ? AND tasks.assign_to = ? LIMIT ?, ?;', [3, $user, $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE tasks.status < ? AND tasks.assign_to = ?', [3, $user]);

        } else {
            $orders = DB::select('SELECT tasks.order_number,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name,users.id,tasks.comment,tasks.deadline,
        tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id
        WHERE tasks.status < ? AND tasks.assign_to = ? AND tasks.priority = ? LIMIT ?, ?;', [3, $user, $rule, $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE tasks.status < ? AND tasks.assign_to = ?', [3, $user]);

        }

        /* $number_of_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [0,1]);
        $number_of_delivery = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [5,1]);

        $number_of_delivered = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [6,1]);
        $number_of_refused = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [7,1]); */

        return [
            $number_of_orders, $orders, /*  $number_of_pending, $number_of_delivery, $number_of_delivered,
        $number_of_refused,  */
        ];

    }
    
    public function get_assigned_tasks($rule, $page, $user)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        if ($rule == 'All') {
            $orders = DB::select('SELECT tasks.order_number,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name,tasks.id,tasks.comment,tasks.deadline,
            tasks.priority,tasks.solved,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_to = users.id
            WHERE tasks.status < ? AND tasks.assign_from = ? LIMIT ?, ?;', [3, $user, $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_to = users.id WHERE tasks.status < ? AND tasks.assign_from = ?', [3, $user]);

        } else {
            $orders = DB::select('SELECT tasks.order_number,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name,users.id,tasks.comment,tasks.deadline,
        tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_to = users.id
        WHERE tasks.status < ? AND tasks.assign_from = ? AND tasks.priority = ? LIMIT ?, ?;', [3, $user, $rule, $offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_to = users.id WHERE tasks.status < ? AND tasks.assign_from = ?', [3, $user]);

        }

        /* $number_of_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [0,1]);
        $number_of_delivery = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [5,1]);

        $number_of_delivered = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [6,1]);
        $number_of_refused = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [7,1]); */

        return [
            $number_of_orders, $orders, /*  $number_of_pending, $number_of_delivery, $number_of_delivered,
        $number_of_refused,  */
        ];

    }
    public function get_archived_tasks($rule, $page, $user)
    {

        $products_per_page = 15;
        $offset = ($page - 1) * $products_per_page;

        if ($rule == "All") {
            $orders = DB::select('SELECT task.id,task.order_number,task.system_name,task.assign_from,task.assign_to,task.user_from,users.name as user_to,task.comment,task.deadline,
            task.priority,task.status,task.image_url,task.created_at,task.updated_at
                         FROM users
                    INNER JOIN (SELECT tasks.id,tasks.order_number,tasks.solved,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name as user_from,tasks.comment,tasks.deadline,
        tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE (tasks.assign_from = ? OR tasks.assign_to = ?)
            ) as task ON users.id = task.assign_to where task.solved = ? AND task.status = ? LIMIT ?, ?;', [$user, $user,3,3,$offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE (tasks.assign_from = ? OR tasks.assign_to = ?) AND tasks.status= ? AND tasks.solved = ?', [$user, $user,3,3]);

        } else {
            $orders = DB::select('SELECT task.order_number,task.system_name,task.assign_from,task.assign_to,task.user_from,users.name as user_to,task.comment,task.deadline,
            task.priority,task.status,task.image_url,task.created_at,task.updated_at
                         FROM users
                    INNER JOIN (SELECT tasks.order_number,tasks.solved,tasks.system_name,tasks.assign_from,tasks.assign_to,users.name as user_from,tasks.comment,tasks.deadline,
        tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE (tasks.assign_from = ? OR tasks.assign_to = ?)
            ) as task ON users.id = task.assign_to where task.solved = ? AND task.status = ? AND task.priority = ? LIMIT ?, ?;', [$user, $user,3,3,$rule,$offset, $products_per_page]);

            $number_of_orders = DB::select('SELECT COUNT(tasks.id) AS NumberOfOrders FROM tasks INNER JOIN users ON tasks.assign_from = users.id WHERE (tasks.assign_from = ? OR tasks.assign_to = ?) AND tasks.status= ? AND tasks.solved = ?', [$user, $user,3,3]);

        }

        /* $number_of_pending = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [0,1]);
        $number_of_delivery = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [5,1]);

        $number_of_delivered = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [6,1]);
        $number_of_refused = DB::select('SELECT COUNT(id) AS NumberOfOrders FROM kshopina.fct where last_update = ? AND source > ? ;', [7,1]); */

        return [
            $number_of_orders, $orders, /*  $number_of_pending, $number_of_delivery, $number_of_delivered,
        $number_of_refused,  */
        ];

    }
    public function add_to_tasks($task)
    {

        DB::insert('insert into tasks (order_number, system_name,assign_from,assign_to,comment,deadline,priority,status,image_url) values (?,?,?,?,?,?,?,?,?)',
            [$task['order_number'], $task['system_name'], $task['assign_from'], $task['assign_to'],
                $task['comment'], $task['deadline'], $task['priority'], $task['status'], $task['image_url']]);
    }
    public function add_to_replies($task)
    {

        DB::insert('insert into replies (case_number,comment,user,mark_as_solved,image_url) values (?,?,?,?,?)',
            [$task['case_number'], $task['comment'], $task['user'], $task['mark_as_solved'], $task['image_url']]);
    }
    public function get_task($id)
    {
        return DB::select('select * from tasks where id = ?', [$id]);
    }

    public function get_task_with_replies($id, $mode)
    {
        if ($mode == 'tasks') {
            $task = DB::select('SELECT replies.user,replies.comment as reply,replies.image_url as reply_image_url,replies.created_at as reply_created_at,
            task.id,task.order_number,task.system_name,task.solved,task.assign_from,task.assign_to,task.name,task.comment,task.deadline,
                        task.priority,task.status,task.image_url,task.created_at,task.updated_at
                         FROM replies
            INNER JOIN (SELECT tasks.id,tasks.order_number,tasks.system_name,tasks.solved,tasks.assign_from,tasks.assign_to,users.name,tasks.comment,tasks.deadline,
            tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id
            WHERE tasks.id = ?) as task ON replies.case_number = task.id WHERE replies.case_number = ? ', [$id, $id]);

            if (empty($task)) {
                $task = DB::select('SELECT tasks.id,tasks.order_number,tasks.system_name,tasks.solved,tasks.assign_from,tasks.assign_to,users.name,tasks.comment,tasks.deadline,
                tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_from = users.id
                WHERE tasks.id = ?', [$id]);
            }
        } else {
            $task = DB::select('SELECT replies.user,replies.comment as reply,replies.image_url as reply_image_url,replies.created_at as reply_created_at,
            task.id,task.order_number,task.system_name,task.solved,task.assign_from,task.assign_to,task.name,task.comment,task.deadline,
                        task.priority,task.status,task.image_url,task.created_at,task.updated_at
                         FROM replies
            INNER JOIN (SELECT tasks.id,tasks.order_number,tasks.system_name,tasks.solved,tasks.assign_from,tasks.assign_to,users.name,tasks.comment,tasks.deadline,
            tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_to = users.id
            WHERE tasks.id = ?) as task ON replies.case_number = task.id WHERE replies.case_number = ? ', [$id, $id]);

            if (empty($task)) {
                $task = DB::select('SELECT tasks.id,tasks.order_number,tasks.system_name,tasks.solved,tasks.assign_from,tasks.assign_to,users.name,tasks.comment,tasks.deadline,
                tasks.priority,tasks.status,tasks.image_url,tasks.created_at,tasks.updated_at FROM tasks INNER JOIN users ON tasks.assign_to = users.id
                WHERE tasks.id = ?', [$id]);
                }
        }

        return $task;

    }
    public function update_task_status($data, $user)
    {

        $table = ['status' => 'status'];
        $query = [];
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        foreach ($data as $id => $values) {
            foreach ($values as $key => $value) {

                $query[$table[$key]] = $value;

            }

            $query['updated_at'] = $date;

            $task = $this->get_task($id)[0];

            if ($query['status'] == 3) {
                if ($task->assign_from == $user) {

                    if ($task->solved == 2) {
                        $query['status'] = 3;
                        $query['solved'] = 3;
                    } else {
                        $query['status'] = 2;
                        $query['solved'] = 1;
                    }
                } else {
                    if ($task->solved == 1) {
                        $query['status'] = 3;
                        $query['solved'] = 3;
                    } else {
                        $query['status'] = 2;
                        $query['solved'] = 2;
                    }
                }
            }

            DB::table('tasks')->where('id', $id)
                ->update($query);

        }
        return count($data);
    }

    public function mark_as_solved($id, $user)
    {

        $task = DB::select('select * from tasks where id = ?', [$id])[0];

        if ($task->assign_from == $user) {

            if ($task->solved == 2) {
                $query['status'] = 3;
                $query['solved'] = 3;
            } else {
                $query['status'] = 2;
                $query['solved'] = 1;
            }
        } else {
            if ($task->solved == 1) {
                $query['status'] = 3;
                $query['solved'] = 3;
            } else {
                $query['status'] = 2;
                $query['solved'] = 2;
            }
        }
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['updated_at'] = $date;

        DB::table('tasks')->where('id', $id)
            ->update($query);
    }

    public function change_task_status($id, $status)
    {
        date_default_timezone_set('Africa/Cairo');
        $date = date('Y-m-d H:i:s', time());

        $query['updated_at'] = $date;
        $query['status'] = $status;
        DB::table('tasks')->where('id', $id)
            ->update($query);

    }
}
