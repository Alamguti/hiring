<template>
  <div class="container">
    <Modal :title="modalTitle" @closed="handleModalClosed">
      <!-- Contenido del modal -->
      <p>Contenido del modal aquí.</p>
    </Modal>
    <div class="col-12">
      <prueba-component></prueba-component>
      <div class="row">
        <h1 class="text-center text-white p-5">DASHBOARD</h1>
      </div>
      <!-- Formulario para agregar nuevas tareas -->
      <div class="row">
        <div class="col-8 offset-2">
          <h2 class="text-center text-white">Agregar Nueva Tarea</h2>

          <form @submit.prevent="agregarTarea">
            <div class="mb-3">
              <label for="tarea" class="form-label text-white">Nombre de la Tarea</label>
              <input type="text" class="form-control" id="tarea" v-model="nuevaTarea" required />
            </div>
            <button type="submit" class="btn btn-success">Agregar Tarea</button>
          </form>
        </div>
      </div>

      <!-- Agregar tabla de tareas -->
      <div class="row">
        <div class="col-8 offset-2">
          <h2 class="text-center text-white">Lista de Tareas</h2>

          <!-- Tabla de tareas con Bootstrap -->
          <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tarea</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody>
              <!-- Utilizar v-for para iterar sobre las tareas -->
              <tr v-for="(tarea, index) in tareas" :key="index">
                <th class="col-2" scope="row">{{ tarea.id }}</th>
                <td class="col-6">{{ tarea.nombre }}</td>
                <td class="col-4">
                  <button @click="editarTarea(index)" type="button" class="btn btn-primary">
                    Editar
                  </button>
                  &nbsp;
                  <button @click="eliminarTarea(index)" type="button" class="btn btn-danger">
                    Eliminar
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import ModalComponent from "./components/ModalComponent.vue";

export default {
  components: { ModalComponent },
  data() {
    return {
      nuevaTarea: "", // Almacena el nombre de la nueva tarea
      tareas: [], // Almacena la lista de tareas
      usuario: {}
    };
  },
  mounted() {
    this.listarTareas()
    this.usuario = this.$user;
  },
  methods: {

    async listarTareas() {
      try {
        const response = await fetch('api/tareas')

        if (response.ok) {
          const data = await response.json()
          this.tareas = data
        }

      } catch (error) {
        console.error('Error al cargar tareas:', error)
      }
    },
    async agregarTarea() {
      console.log(this.usuario)
      try {
        const response = await fetch('api/agregar-tarea', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify({
            nombre: this.nuevaTarea,
            usuario: this.usuario
          }),
        })

        const data = await response.json()
        this.tareas.push(data)
        this.nuevaTarea = ""

      } catch (error) {
        console.error('Error al agregar Tarea:', error)
      }

    },
    editarTarea(index) {

    },
    async eliminarTarea(index) {
      const tareaId = this.tareas[index].id

      try{
        const response = await fetch(`api/eliminar-tarea/${tareaId}`,{
          method:'DELETE',
          headers:{
            'Content-Type': 'application/json',
          }
        })
        if(response.ok){
          this.listarTareas()
        }

      }catch(error){
        console.error('Error al eliminar la tarea:', error);
      }
    },
  }
}
</script>

