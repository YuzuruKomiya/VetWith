<?php

class Controller_Contact extends Controller_Template_EveryUserTemplate
{
	public function forge_contact_form()
	{
		$form = Fieldset::forge();
			
		$form->add('name', 'お名前', array(
			'class'			=> 'form-control',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 20);
		
		$form->add('email', 'メールアドレス', array(
			'class'			=> 'form-control',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab_and_newline')
			->add_rule('min_length', 1)
			->add_rule('max_length', 100)
			->add_rule('valid_email');
		
		$form->add('phone_number', '電話番号', array(
			'class' => 'form-control'
			))
			->add_rule(function($form) { return mb_convert_kana($form, 'rn');})
			->add_rule('trim')
			->add_rule('no_tab_and_newline')
			->add_rule('phone_number')
			->add_rule('max_length', 15);
			
		$form->add('comment', 'コメント（300文字以内）', array(
			'type'	=> 'textarea',
			'cols'	=> 70,
			'rows'	=> 6,
			'class'	=> 'form-control offertextarea',
			))
			->add_rule('trim')
			->add_rule('required')
			->add_rule('no_tab')
			->add_rule('max_length', 300);
		
		$form->add('submit', '', array(
			'type'	=> 'submit',
			'value'	=> 'お問い合わせ内容の確認',
			'class'	=> 'btn btn-primary btn-lg'));
		
		return $form;
	}
	
	public function action_index()
	{
		$form = $this->forge_contact_form();
		
		if (Input::method() === 'POST')
		{
			$form->repopulate();
		}
		
		$this->template->title = 'お問い合わせ';
		$this->template->content = View::forge('contact/index');
		$this->template->content->set_safe('contact_form', $form->build('contact/confirm'));
		return;
	}
	
	public function action_confirm()
	{
		$form = $this->forge_contact_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$form->repopulate();
			$this->template->title = 'お問い合わせ';
			$this->template->content = View::forge('contact/index');
			$this->template->content->set_safe('contact_error', $val->show_errors());
			$this->template->content->set_safe('contact_form', $form->build('contact/confirm'));
			return;
		}
		
		$data['input'] = $val->validated();
		
		$this->template->title = 'お問い合わせ内容の確認';
		$this->template->content = View::forge('contact/confirm', $data);
		return;
	}
	
	public function action_completion()
	{
		if ( ! Security::check_token())
		{
			throw new HttpInvalidInputException('ページ遷移が正しくありません。');
		}
		
		$form = $this->forge_contact_form();
		$val = $form->validation()->add_callable('MyValidationRules');
		
		if ( ! $val->run())
		{
			$form->repopulate();
			$this->template->title = 'お問い合わせ';
			$this->template->content = View::forge('contact/index');
			$this->template->content->set_safe('contact_error', $val->show_errors());
			$this->template->content->set_safe('contact_form', $form->build('contact/confirm'));
			return;
		}
		
		$post = $form->validated();
		
		try
		{
			$mail = new Model_Contact();
			$mail->send($post);
			$this->template->title = 'お問い合わせ';
			$this->template->content = View::forge('contact/completion');
			return;
			
		}
		catch (EmailValidationFailedException $e)
		{
			Log::error(
				'メール検証エラー: ' . $e->getMessage() . __METHOD__
				);
			$contact_error = 'メールアドレスに誤りがあります。';
		}
		catch (EmailSendingFailedException $e)
		{
			Log::error(
				'メール送信エラー: ' . $e->getMessage() . __METHOD__
				);
			$contact_error = 'メールを送信できませんでした。';
		}
		
		$this->template->title = 'メール送信の失敗';
		$this->template->content = View::forge('contact/index');
		$this->template->content->set_safe('contact_error', $contact_error);
	}
}