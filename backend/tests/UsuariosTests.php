<?php
// tests/UsersTest.php

use PHPUnit\Framework\TestCase;
use users\users;
use materiales\materiales;

class UsuariosTests extends TestCase {
    protected $users;
    protected $materials;

    protected function setUp(): void {
        $this->users = new users();
        $this->materials = new materiales();
    }

    public function testPasswordConfirmationDoesNotMatch() {
        $_POST = [
            'register' => true,
            'idEmployee' => '12345',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'username' => 'johndoe',
            'password' => 'password123',
            'password_confirmation' => 'password456',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'role' => 'admin'
        ];

        ob_start();
        $this->users->processRegistration();
        $output = ob_get_clean();

        $this->assertStringContainsString('Las contraseñas no coinciden', $output);
    }

    public function testRequiredFieldsMissing() {
        $_POST = [
            'register' => true,
            'idEmployee' => '',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'username' => 'johndoe',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'role' => 'admin'
        ];

        $output = $this->users->processRegistration();

        $this->assertStringContainsString('Por favor, complete todos los campos', $output);
    }

    public function testInvalidEmailFormat() {
        $_POST = [
            'register' => true,
            'idEmployee' => '12345',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'username' => 'johndoe',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'email' => 'invalid-email',
            'phone' => '1234567890',
            'role' => 'admin'
        ];

        ob_start();
        $this->users->processRegistration();
        $output = ob_get_clean();

        $this->assertStringContainsString('Formato de correo electrónico no válido', $output);
    }

    
}
