<script setup>
import usePhotos from '@/composables/photos'
import { onMounted } from 'vue';

const { photos, getPhotos } = usePhotos()

onMounted(getPhotos)
</script>

<template>
    <h1>Olamilly Photo App</h1>
    
    
    <template v-for="item in photos" :key="item.id">
        <section>
            <div style="background-color:lightgrey; display:flex; align-items:center; padding:5px; margin:1px;">
            <box-icon type='solid' name='user-circle'></box-icon>
            <a href=# style="width:100%" ><p id="username"><span>@</span>{{ item.username }}</p></a></div>
            <img v-bind:src=item.image style="height: 350px; width: 350px;" />
            <p id="caption" style="background-color:lightgrey">Caption: {{ item.caption}} </p>
        
            <div id="btn-group" style="display:flex; align-items:center; justify-content:center;">
                <a data-bs-toggle="modal" data-bs-target="#exampleModal"><box-icon name='trash' style="cursor: pointer; margin:.5rem"></box-icon></a>
                <a class=edit id="{{$post->id}}" ><box-icon name='pencil' style="cursor: pointer; margin:.5rem"></box-icon></a>
            </div>
            <p id=date>Posted on: {{item.created_at.slice(0,10)}}</p>
        </section>
    </template>
    

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center" id="exampleModalLabel">Are you sure?</h5>
                </div>
                <div class="modal-body">
                    This post will be permanently deleted from the database and cannot be recovered.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>                        
                    <button type="submit" class="btn btn-danger">Confirm Delete</button>
                </div>
            </div>
        </div>
    </div>

</template>

<style>
section{
border:1px solid grey;
border-radius:3px;
width:30%;
margin:10px;
margin:10px;
min-width:360px;
text-align:center;
}
#username{
margin-bottom:0;
}
p#caption{
margin-top:0px;
}
h1{
    text-align: center;
    margin-bottom: 1rem;
}
</style>