<?php
    namespace App\Manager;

    use App\Repository\DependenciaRepository;

    class DependenciaManager {
        private $repository;
        public function __construct(DependenciaRepository $repository) {
            $this->repository = $repository;
        }
        public function getDependencias() {
            return $this->repository->findAll();
        }
        public function getDependencia(int $id) {
            return $this->repository->find($id);
        }
    }
?>