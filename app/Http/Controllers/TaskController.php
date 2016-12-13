<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Sentinel;
use Validator;
use Illuminate\Http\Request;
use Session;
use Reminder;
use Mail;

use App\Models\Project;
use App\Models\TaskState;

class TaskController extends Controller {

	public function getIndex($project_id){
		$project = Project::with('tasks')->find($project_id);
		if( !$project ) return redirect('project')->withMessage('could not find tasks for given project');

		return view('task.index', [
			'project'     => $project
		]);
	}

	public function postEdit(Request $request, $id = 0){
		$rules = [
            'name' => 'required'
        ];
        $v = Validator::make($request->all(), $rules);

        if( $v->fails() ){
            return redirect('task/edit'. ($id?"/$id":''))->withErrors($v)->withInput();
        }

        if( $id ){
            $task = Task::find($id);
            if( !$project ) return redirect('project')->withMessage('Could not find task with the provided id');
        }else{
            $task = new Task;
        }

        $task->name = $request->input('name');
        $task->user_id = $request->input('user_id');
        $task->description = $request->input('description');
		$task->due_date = date('Y-m-d H:i:s', time()+60*60*24*7);
		$task->state_id = $request->input('state_id');
		$task->project_id = $request->input('project_id');
        $task->save();

        $message = $id ? 'Task has been updated' : 'Task has been created';
        return redirect('task/'.$task->project_id)->withMessage($message);
	}

	public function getEdit($id = 0){
		$task = $id ? Task::find($id) : null;
		$users = User::get();
		$task_states = TaskState::get();
		$projects = Project::where('status', '<>', 'Done')->get();

		return view('task.edit', [
			'task'        => $task,
			'projects'    =>  $projects,
			'users'       =>  $users,
			'task_states' => $task_states
		]);
	}

}