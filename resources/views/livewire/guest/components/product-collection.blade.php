<!-- ✅ Grid Section - Starts Here 👇 -->
<section id="ProductsCollection">
    <div class="w-full sm:w-fit overflow-hidden mx-auto grid grid-cols-2 lg:grid-cols-4 md:grid-cols-3
             sm:grid-cols-2 justify-items-center
              justify-center gap-y-8 gap-x-3 sm:gap-x-8 py-5 px-4">
        @foreach ($products as $d)
            <x-public.product-card :product="$d" />
        @endforeach
    </div>

    <div class="w-10/12 my-4 mx-auto">
        {{ $products->links() }}

    </div>

</section>
