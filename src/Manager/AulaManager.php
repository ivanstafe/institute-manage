<?php
    namespace App\Manager;

    use App\Repository\AulaRepository;

    class AulaManager {
        private $repository;
        public function __construct(AulaRepository $repository) {
            $this->repository = $repository;
        }
        public function getAulas() {
            return $this->repository->findAll();
        }
        public function getAula(int $id) {
            return $this->repository->find($id);
        }
    }
?>