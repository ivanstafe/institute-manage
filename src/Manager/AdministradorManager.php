<?php
    namespace App\Manager;

    use App\Repository\AdministradorRepository;

    class AdministradorManager {
        private $repository;
        public function __construct(AdministradorRepository $repository) {
            $this->repository = $repository;
        }
        public function getAdministradores() {
            return $this->repository->findAll();
        }
        public function getAdministrador(int $id) {
            return $this->repository->find($id);
        }
    }
?>