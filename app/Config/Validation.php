<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var string[]
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'   => 'CodeIgniter\Validation\Views\list',
        'single' => 'CodeIgniter\Validation\Views\single',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
    public $estudiantes = [
        'nombres' => 'required|min_length[3]|max_length[50]|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ]+$/u]',
        'apellidos' => 'required|min_length[3]|max_length[50]',
        'email' => 'required|valid_email',
        'fecha_nacimiento' => 'required|valid_date[Y-m-d]',
        'direccion' => 'required|min_length[5]|max_length[100]|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/u]',
    ];

    public $users = [
        'nombres' => 'required|min_length[3]|max_length[50]|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ]+$/u]',
        'username' => 'required|min_length[4]|max_length[20]|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/u]',
        'password' => 'required|min_length[8]|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/u]',
        'email' => 'required|valid_email',
    ];

    public $login = [
        'username' => 'required',
        'password' => 'required',
    ];

    public $cursos = [
        'nivel' => 'required|numeric',
        'seccion' => 'required|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/u]|max_length[50]',
        'periodo' => 'required|regex_match[/^[\pL\sñÑáéíóúÁÉÍÓÚüÜ0-9\-]+$/u]|max_length[50]',
    ];
}
