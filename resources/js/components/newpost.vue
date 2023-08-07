<template>
    <div id="container">
        <a href="/"><box-icon name='arrow-back'></box-icon></a>
        <h1>Form</h1>
        <form method="post" enctype="multipart/form-data"><!--i want to redirect to homeindex.vue after i submit this form-->
            
            <div>
            <label for="name">Username</label>
            <!-- i want the currently logged in username to show in the username input box on load-->
            <input name="username" value="???"/></div>

            <label style="width:40%; margin-top:1rem">Content</label>
            <div id="content">
            <div>
                <label for="image" class="form-label" style="width:100%;">Image File</label>
                <input class="form-control form-control-sm mb-2" name="image" id="formFileSm" type="file">
            </div>
            <div>
                <label for="caption" style="width:100%;">Caption</label>
                <input name="caption" style="width:100%"/>
            </div>
            </div>
            <button class="btn btn-primary">Submit</button>
        </form>
    </div>
</template>

<script setup>
    import useNewPhoto from '@/composables/newphoto'
</script>

<style>
        h1{
            text-align:center;
        }
        form{
            display:flex;
            flex-direction:column;
            align-items:center;
        }
        form>div{
            margin:5px;
            display:flex;
            flex-direction:column;
            width:40%;
        }
        input{
            padding:.5rem;
            border-radius:5px;
        }
        button{
            margin:5px;
        }
        #content{
            border:1px solid lightgrey; 
            border-radius:5px;
            display:flex; 
            margin-top:0px;
            flex-direction:column; 
            justify-content:space-around;
            align-items:center;
            padding:.7rem;
            min-height:250px;
        }
        #content>div{
            width:100%;
        }
</style>