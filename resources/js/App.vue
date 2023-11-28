<template>
    <div class="container">
        <div class="col-12">
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
                            <input type="text" class="form-control" id="tarea" v-model="nuevaTarea" required>
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
                                    <button type="button" class="btn btn-primary">Editar</button> &nbsp;
                                    <button type="button" class="btn btn-danger">Eliminar</button>
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
export default {
    data() {
        return {
            nuevaTarea: "", // Almacena el nombre de la nueva tarea
            tareas: [] // Almacena la lista de tareas
        };
    },
    methods: {
        agregarTarea() {
            // Agregar la nueva tarea al array de tareas
            this.tareas.push({
                id: this.tareas.length + 1,
                nombre: this.nuevaTarea
            });

            // Limpiar el campo después de agregar la tarea
            this.nuevaTarea = "";
        }
    }
};
</script>

