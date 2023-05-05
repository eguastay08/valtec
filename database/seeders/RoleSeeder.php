<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Necesitamos los roles de admin => all y diseño => ver banners, diseño y sliders
        $admin = Role::create(['name' => 'admin']);
        $diseño = Role::create(['name'=>'diseño']);

        Permission::create(['name' => 'admin.inicio', 'descripcion' => 'dashboard'])->syncRoles([$admin, $diseño]);
        Permission::create(['name'=>'admin.categorias.index', 'descripcion' => 'Listado de Categorias'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.crear', 'descripcion' => 'Registro Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.actualizar', 'descripcion' => 'Actualizar Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.borrar', 'descripcion' => 'Eliminar Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.activar', 'descripcion' => 'Activar Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.desactivar', 'descripcion' => 'Desactivar Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.categorias.show', 'descripcion' => 'Mostrar Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.subcategorias.crear', 'descripcion' => 'Registro Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.subcategorias.actualizar', 'descripcion' => 'Actualizar Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.subcategorias.borrar', 'descripcion' => 'Eliminar Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.subcategorias.activar', 'descripcion' => 'Activar Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.subcategorias.desactivar', 'descripcion' => 'Desactivar Subcategorías'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.productos.index', 'descripcion' => 'Listado de Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.crear', 'descripcion' => 'Registro de Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.actualizar', 'descripcion' => 'Actualizar Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.borrar', 'descripcion' => 'Eliminar Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.activar', 'descripcion' => 'Activar Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.desactivar', 'descripcion' => 'Desactivar Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.agotado', 'descripcion' => 'Agotado Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.codigos', 'descripcion' => 'Listado de Códigos Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.codigos.crear', 'descripcion' => 'Registro de Códigos Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.codigos.editar', 'descripcion' => 'Actualizar Código Productos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.productos.codigos.borrar', 'descripcion' => 'Eliminar Código Productos'])->syncRoles([$admin]);
            
        Permission::create(['name'=>'admin.sliders.index', 'descripcion' => 'Listado de Sliders'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.crear', 'descripcion' => 'Registro de Slider'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.actualizar', 'descripcion' => 'Actualizar Slider'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.eliminar', 'descripcion' => 'Eliminar Slider'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.activar', 'descripcion' => 'Activar Slider'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.desactivar', 'descripcion' => 'Desactivar Slider'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.sliders.popup', 'descripcion' => 'Popup Slider'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.banners.index', 'descripcion' => 'Listado de Banners'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.banners.crear', 'descripcion' => 'Registro de Banner'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.banners.actualizar', 'descripcion' => 'Actualizar Banner'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.banners.eliminar', 'descripcion' => 'Eliminar Banner'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.banners.activar', 'descripcion' => 'Activar Banners'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.banners.desactivar', 'descripcion' => 'Desactivar Banners'])->syncRoles([$admin, $diseño]);
        
        Permission::create(['name'=>'admin.tags.index', 'descripcion' => 'Listado de Tags'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.tags.crear', 'descripcion' => 'Registro de Tags'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.tags.actualizar', 'descripcion' => 'Actualizar Tags'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.tags.eliminar', 'descripcion' => 'Eliminar Tags'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.tags.activar', 'descripcion' => 'Activar Tags'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.tags.desactivar', 'descripcion' => 'Desactivar Tags'])->syncRoles([$admin]);

        Permission::create(['name' => 'admin.disenio.index', 'descripcion' => 'Listado de Bloques'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.crear', 'descripcion' => 'Registro de Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.actualizar', 'descripcion' => 'Actualizar Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.eliminar', 'descripcion' => 'Eliminar Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.activar', 'descripcion' => 'Activar Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.desactivar', 'descripcion' => 'Desactivar Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.up', 'descripcion' => 'Subir Bloque'])->syncRoles([$admin, $diseño]);
        Permission::create(['name' => 'admin.disenio.down', 'descripcion' => 'Bajar Bloque'])->syncRoles([$admin, $diseño]);

        Permission::create(['name'=>'admin.preguntas.index', 'descripcion' => 'Listado de Preguntas Frecuentes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.preguntas.crear', 'descripcion' => 'Registro de Preguntas Frecuentes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.preguntas.actualizar', 'descripcion' => 'Actualizar Preguntas Frecuentes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.preguntas.eliminar', 'descripcion' => 'Eliminar Preguntas Frecuentes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.preguntas.activar', 'descripcion' => 'Activar Preguntas Frecuentes'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.preguntas.desactivar', 'descripcion' => 'Desactivar Preguntas Frecuentes'])->syncRoles([$admin]);
    
        Permission::create(['name'=>'admin.usuarios.index', 'descripcion' => 'Listado de Usuarios'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.crear', 'descripcion' => 'Registro de Usuario'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.actualizar', 'descripcion' => 'Actualizar Usuario'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.eliminar', 'descripcion' => 'Eliminar Usuario'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.activar', 'descripcion' => 'Activar Usuario'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.usuarios.desactivar', 'descripcion' => 'Desactivar Usuario'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.roles.index', 'descripcion' => 'Listado de Roles'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.roles.crear', 'descripcion' => 'Registro de Rol'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.roles.actualizar', 'descripcion' => 'Actualizar Rol'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.roles.eliminar', 'descripcion' => 'Eliminar Rol'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.roles.activar', 'descripcion' => 'Activar Rol'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.roles.desactivar', 'descripcion' => 'Desactivar Rol'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.medios_pago.index', 'descripcion' => 'Listado de Medios de Pago'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.medios_pago.crear', 'descripcion' => 'Registro de Medios de Pago'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.medios_pago.actualizar', 'descripcion' => 'Actualizar Medios de Pago'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.medios_pago.eliminar', 'descripcion' => 'Eliminar Medios de Pago'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.medios_pago_activar', 'descripcion' => 'Activar Medio de Pago'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.medios_pago.desactivar', 'descripcion' => 'Desactivar Medio de Pago'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.moneda.index', 'descripcion' => 'Listado de Monedas'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.moneda.crear', 'descripcion' => 'Registro de Moneda'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.moneda.actualizar', 'descripcion' => 'Actualizar Moneda'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.moneda.eliminar', 'descripcion' => 'Eliminar Moneda'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.moneda.activar', 'descripcion' => 'Activar Moneda'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.moneda.desactivar', 'descripcion' => 'Desactivar Moneda'])->syncRoles([$admin]);
        
        Permission::create(['name'=>'admin.menu.index', 'descripcion' => 'Listado de Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.crear', 'descripcion' => 'Registro de Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'aadmin.menu.actualizar', 'descripcion' => 'Actualizar Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.eliminar', 'descripcion' => 'Eliminar Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.activar', 'descripcion' => 'Activar Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.desactivar', 'descripcion' => 'Desactivar Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.up', 'descripcion' => 'Subir Posicion Menu'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.menu.down', 'descripcion' => 'Bajar Posicion Menu'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.estilos.index', 'descripcion' => 'Listado de Estilos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.estilos.actualizar', 'descripcion' => 'Actualizar Estilos'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.configuracion.index', 'descripcion' => 'Listado de configuraciones'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.configuracion.actualizar', 'descripcion' => 'Actualizar Configuraciones'])->syncRoles([$admin]);
    
        Permission::create(['name'=>'admin.descuentos.index', 'descripcion' => 'Listar Descuentos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.descuentos.crear', 'descripcion' => 'Registro de Descuentos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.descuentos.actualizar', 'descripcion' => 'Actualizar Descuentos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.descuentos.eliminar', 'descripcion' => 'Eliminar Descuentos'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.descuentos.activar', 'descripcion' => 'Activar Descuento'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.descuentos.desactivar', 'descripcion' => 'Desactivar Descuento'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.suscripciones.index', 'descripcion' => 'Listado de Suscripciones'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.suscripciones.eliminar', 'descripcion' => 'Eliminar Suscripción'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.noticias_categorias.index', 'descripcion' => 'Listado de Noticias Categorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_categorias.crear', 'descripcion' => 'Registro de Noticias Categorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'aadmin.noticias_categorias.actualizar', 'descripcion' => 'Actualizar Noticia Categoria'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_categorias.eliminar', 'descripcion' => 'Eliminar Noticia Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_categorias.activar', 'descripcion' => 'Activar Noticia Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_categorias.desactivar', 'descripcion' => 'Desactivar Noticia Categoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_categorias.visualizar', 'descripcion' => 'Visualizar Noticia Sub Categorías'])->syncRoles([$admin]);
        
        Permission::create(['name'=>'admin.noticias_subcategorias.crear', 'descripcion' => 'Crear Noticias Subcategorías'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_subcategorias.actualizar', 'descripcion' => 'Actualizar Noticia Subcategoria'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_subcategorias.eliminar', 'descripcion' => 'Eliminar Noticia Subcategoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_subcategorias.activar', 'descripcion' => 'Activar Noticia Subcategoría'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_subcategorias.desactivar', 'descripcion' => 'Desactivar Noticia Subcategoría'])->syncRoles([$admin]);
        
        Permission::create(['name'=>'admin.noticias_etiquetas.index', 'descripcion' => 'Listado de Noticias Etiquetas'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_etiquetas.crear', 'descripcion' => 'Crear Noticia Etiqueta'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_etiquetas.actualizar', 'descripcion' => 'Actualizar Noticia Etiqueta'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_etiquetas.eliminar', 'descripcion' => 'Eliminar Noticia Etiqueta'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_etiquetas.activar', 'descripcion' => 'Activar Noticia Etiqueta'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias_etiquetas.desactivar', 'descripcion' => 'Desactivar Noticia Etiqueta'])->syncRoles([$admin]);
    
        Permission::create(['name'=>'admin.noticias.index', 'descripcion' => 'Listado de Noticias'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias.crear', 'descripcion' => 'Crear Noticia'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias.actualizar', 'descripcion' => 'Actualizar Noticia'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias.eliminar', 'descripcion' => 'Eliminar Noticia'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias.activar', 'descripcion' => 'Activar Noticia'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.noticias.desactivar', 'descripcion' => 'Desactivar Noticia'])->syncRoles([$admin]);

        Permission::create(['name'=>'admin.libro_reclamaciones.index', 'descripcion' => 'Listado de Libro de Reclamaciones'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.libro_reclamaciones.mostrar', 'descripcion' => 'Mostrar Libro de Reclamaciones'])->syncRoles([$admin]);
        Permission::create(['name'=>'admin.libro_reclamaciones.eliminar', 'descripcion' => 'Eliminar Libro de Reclamaciones'])->syncRoles([$admin]);
    }
}
