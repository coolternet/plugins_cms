<?php
defined('EVO') or die;

return new class extends Evo\Module
{
	public function init(){

		
		if(defined('EVO_ADMIN')){
			require_once __DIR__ .'/pages_admin/core/functions.php';
		}else{
			require_once __DIR__ .'/pages_user/core/functions.php';
		}
		
		parent::route('/support', function($params) {
			return __DIR__ . '/pages_user/main.php';
		});

		parent::route('/support/create', function($params) {
			return __DIR__ . '/pages_user/create.php';
		});

		parent::route('/support/view', function($params) {
			return __DIR__ . '/pages_user/view.php';
		});
	}

	public function activate()
	{

		\DB::CreateTable('tss_ticket', [
			'id'			=> 'increment', 
			'sid'			=> 'integer',
			'subject'		=> 'string',
			'short_desc'	=> 'string',
			'assignation'	=> array('integer', 0),
			'level'			=> array('integer', 0),
			'create_date'	=> 'dateTime',
			'close_date'	=> array('datetime', NULL),
			'availability'	=> array('integer', '1'),
		], false, true);

		\DB::CreateTable('tss_content', [
			'id'			=> 'increment', 
			'tid'			=> 'integer',
			'sid'			=> 'integer',
			'mid'			=> 'integer',
			'msg'			=> 'text',
			'send_date'		=> 'dateTime',
			'ip'			=> 'string'
		], false, true);

		\DB::CreateTable('tss_rates', [
			'id'			=> 'increment', 
			'tid'			=> 'integer',
			'sid'			=> 'integer',
			'score'			=> 'integer',
			'comment'		=> 'text',
			'send_date'		=> 'dateTime'
		], false, true);

		\DB::CreateTable('tss_admin_notes', [
			'id'			=> 'increment', 
			'tid'			=> 'integer', 
			'cid'			=> 'integer',
			'note'			=> 'text',
			'assignation'	=> 'integer',
			'send_date'		=> 'dateTime'
		], false, true);

		\DB::Insert('tss_ticket', [
			'id'			=> '0',
			'sid'			=> App::getCurrentUser()->id,
			'subject'		=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut ac.',
			'short_desc'	=> 'Short description for casual',
			'assignation'	=> '1',
			'create_date'	=> date("Y-m-d H:i:s")
		]);

		\DB::Insert('tss_admin_notes', [
			'tid'			=> '0',
			'cid'			=> App::getCurrentUser()->id,
			'note'			=> 'Utilisateur complètement grossier et disgracieux.',
			'assignation'	=> '1',
			'send_date'		=> date("Y-m-d H:i:s")
		]);

		\DB::Insert('tss_content', [
			'tid'			=> '0',
			'sid'			=> App::getCurrentUser()->id,
			'mid'			=> '1',
			'msg'			=> 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam laoreet justo id pulvinar rutrum. Curabitur vel quam magna. Aliquam erat volutpat. Maecenas laoreet finibus congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nam vitae posuere sapien. Aenean eros justo, venenatis et fermentum nec, vestibulum.',
			'send_date'		=> date("Y-m-d H:i:s"),
			'ip'			=> $_SERVER['REMOTE_ADDR']
		]);

		App::setNotice("Ticket system is enable");
	}

	public function deactivate()
	{
		\DB::DropTable('tss_ticket');
		\DB::DropTable('tss_content');
		\DB::DropTable('tss_rates');
		\DB::DropTable('tss_admin_notes');
		App::setNotice("Ticket system is disable");
	}

	public function hook_user_menu(array &$items)
	{
		$items[] = [__('ticket_system/plugin.menu_1'), 'fa-question-circle', APP::getURL('/support')];
	}
	
	public function hook_admin_menu(array &$items)
	{
		$items[] = ['Panel Ticket Support', 'fa-question-circle', '/admin/?p=ticket_system/home', null];
	}

};