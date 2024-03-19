<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit a Product</h1>
    <form method="post" action="{{route('products.update', $product->id)}}">
        @csrf
        @method('put')
        <div>
            <label>Name</label>
            <input type="text" name="name" placeholder="Name" value = "{{$product->name}}"/>
        </div>
        <div>
            <label>Quantity</label>
            <input type="number" name="quantity" placeholder="Quantity" value = "{{$product->quantity}}" />
        </div>
        <div>
            <label>Price</label>
            <input type="number" name="price" placeholder="Price" value = "{{$product->price}}" />
        </div>
        <div>
            <label>Description</label>
            <input type="text" name="description" placeholder="Description" value = "{{$product->description}}" />
        </div>
        <div>
            <input type="submit" value="Update" />
        </div>
    </form>
    <div>
        <h5><a href="{{route('products.index')}}">Return to Homepage</a></h5>
    </div>
</body>
</html>
