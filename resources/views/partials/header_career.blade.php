<style>
    .career-header {
        background-color: #0b0b54;
        padding: 40px 0 20px 0;
        text-align: center;
    }

    .career-search {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
    }

    .search-box {
        position: relative;
        width: 900px;
        max-width: 95%;
    }

    .search-box input {
        width: 100%;
        padding: 12px 15px 12px 40px;
        border-radius: 8px;
        border: none;
        outline: none;
        font-size: 16px;
    }

    .search-box .fa-search {
        position: absolute;
        top: 50%;
        left: 12px;
        transform: translateY(-50%);
        color: #666;
        font-size: 16px;
    }

    .career-search button {
        background-color: #ff007f;
        border: none;
        padding: 12px 25px;
        border-radius: 8px;
        color: #fff;
        font-weight: bold;
        cursor: pointer;
    }

    .career-menu {
        background-color: #002e6d;
        padding: 15px 0;
        text-align: center;
        margin-bottom: 40px;
    }

    .career-menu ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 150px;
    }

    .career-menu ul li {
        color: #fff;
        font-size: 18px;
        font-weight: 500;
        cursor: pointer;
        padding-bottom: 8px;
        position: relative;
    }

    /* Hapus efek khusus pada Jelajahi Karier */
    .career-menu ul li a {
        color: #fff;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .career-menu ul li a:hover {
        text-decoration: underline;
    }

    @media (max-width: 992px) {
        .career-menu ul {
            gap: 40px;
            flex-wrap: wrap;
        }
    }
</style>

<div class="career-header">
    <form action="#" method="GET" class="career-search">
        <div class="search-box">
            <i class="fa fa-search"></i>
            <input type="text" placeholder="Misalnya, perawat, rekayasawan, akuntan, penjualan..." />
        </div>
        <button type="submit">Cari</button>
    </form>
</div>

<div class="career-menu">
    <ul>
        <li><a href="{{ route('career.explore') }}">Jelajahi karier</a></li>
        <li><a href="{{ route('salary.explore') }}">Jelajahi gaji</a></li>
        <li><a href="{{ route('job.search.page') }}">Pencarian lowongan kerja</a></li>
        <li><a href="{{ route('job.life') }}">Kehidupan kerja</a></li>
    </ul>
</div>
