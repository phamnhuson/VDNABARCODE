<?php
	namespace App\Repositories\Fastas;
	
	use App\Repositories\Abstracts\AbstractFastaRepository;
	
	class NucleotideRepository extends AbstractFastaRepository
	{
		protected $dataFileName = 'nucleotide_db';
	}