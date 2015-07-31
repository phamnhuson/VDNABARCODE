<?php
	namespace Models;
	
	use Eloquent;

	class Message extends Eloquent
	{
	
		protected $table = 'message';
		
		protected $fillable = ['email', 'subject', 'content', 'status'];
	
	}