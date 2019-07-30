<div class="js-content">
    <p><a href="https://baijunyao.com/article/153" target="_blank">全文搜索和中文分词</a>主要介绍了两组全文搜索加中文分词方案；<br><a
            href="https://baijunyao.com/article/154"
            target="_blank">TNTSearch+jieba-php</a>这套组合对于博客这类的小项目基本够用了；<br>但是如果最求性能追求更强大的功能的话；<br>那更优的选择就非 elasticsearch
        莫属了；<br>elasticsearch 需要 java8 以上；<br>这里安装最新版的 java10 ；<br>下载 jdk</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">wget</span> --no-cookies --no-check-certificate --header <span class="token string">"Cookie: gpw_e24=http:%2F%2Fwww.oracle.com%2F; oraclelicense=accept-securebackup-cookie"</span> <span class="token string">"http://download.oracle.com/otn-pub/java/jdk/10.0.1+10/fb4372174a714e6b8c52526dc134031e/jdk-10.0.1_linux-x64_bin.rpm"</span><span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>因为版本会一直升级；<br>如果执行上面这段代码返回了 ERROR 404: Not Found ；<br>那说明有新版本了；<br>那就自己去官网复制最新的下载链接；<br><a
            href="http://www.oracle.com/technetwork/java/javase/downloads/jdk10-downloads-4416644.html"
            target="_blank">http://www.oracle.com/technetwork/java/javase/downloads/jdk10-downloads-4416644.html</a>
        ;<br><a class="js-fluidbox fluidbox__instance-1 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f876ad730.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f876ad730.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 750px; height: 419.203px; top: 0px; left: 0px;"></div>
            </div>
        </a><br>选中 Accept License Agreement 然后在 jdk-10.0.1_linux-x64_bin.rpm 上右键复制链接地址；<br>替换上面命令中的下载链接；</p>
    <p>安装 jdk 注意文件名要跟链接中的保持一直；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> <span class="token function">rpm</span> -ivh jdk-10.0.1_linux-x64_bin.rpm<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>能查看到版本号则表示安装成功；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash">java -version<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>下载 elasticsearch ；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">wget</span> https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.2.4.rpm<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>安装 elasticsearch ；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> <span class="token function">rpm</span> -ivh elasticsearch-6.2.4.rpm<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>安装完成后编辑配置项</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">vim</span> /etc/elasticsearch/elasticsearch.yml<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>去掉下面三行的注释；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash">bootstrap.memory_lock: <span class="token boolean">true</span>
network.host: <span class="token number">192.168</span>.0.1
http.port: <span class="token number">9200</span><span aria-hidden="true" class="line-numbers-rows"><span></span><span></span><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>然后把 network.host 改成 <code>localhost</code><br><a
            class="js-fluidbox fluidbox__instance-2 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f885156ea.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f885156ea.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 653px; height: 406px; top: 0px; left: 0px;"></div>
            </div>
        </a></p>
    <p>启动 elasticsearch ；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> systemctl daemon-reload
<span class="token function">sudo</span> systemctl <span class="token builtin class-name">enable</span> elasticsearch.service
<span class="token function">sudo</span> systemctl start elasticsearch<span aria-hidden="true" class="line-numbers-rows"><span></span><span></span><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>稍等片刻给 elasticsearch 个启动的时间；<br>因为 elasticsearch 启动的略慢；<br>后续涉及到重启 elasticsearch 的时候也都记得稍等片刻；</p>
    <p>然后查看 9200 端口检查是否成功启动；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">netstat</span> -plntu<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-3 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f88f7ea53.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f88f7ea53.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 624px; height: 145px; top: 0px; left: 0px;"></div>
            </div>
        </a></p>
    <p>如果半天过后仍然没有启动起来；<br>可能是内存不够出错；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">vim</span> /etc/elasticsearch/jvm.options<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>把内存改为自己服务器内存的一半以下；<br>比如说这里改为 512M ；<br><a
            class="js-fluidbox fluidbox__instance-4 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180606/5b17771055b51.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180606/5b17771055b51.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 500px; height: 193px; top: 0px; left: 0px;"></div>
            </div>
        </a><br>尝试启动；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> systemctl restart elasticsearch<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>查看状态是否正常；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">curl</span> <span class="token string">'localhost:9200'</span><span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-5 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f89b8e846.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f89b8e846.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 473px; height: 262px; top: 0px; left: 0px;"></div>
            </div>
        </a></p>
    <p>至此 elasticsearch 算是安装完成了；<br>但是如果想用来搜索中文；<br>还需要安装中文分词；<br>怎么算分词呢？<br><a href="https://baijunyao.com/article/153"
            target="_blank">全文搜索和中文分词</a> 文章中已经简单介绍过了；<br>这里我们从 elasticsearch 实战一遍；<br>比如说 <code>白俊遥技术博客</code>
        这句话；<br>elasticsearch内置的分词器对中文相当不友好；<br>只会一个只一个字的分；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">curl</span> -H <span class="token string">'Content-Type: application/json'</span>  -XGET <span class="token string">'localhost:9200/_analyze?pretty'</span> -d <span class="token string">'{"text":"白俊遥技术博客"}'</span><span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-6 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f8b4333cf.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f8b4333cf.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 750px; height: 642.109px; top: 0px; left: 0px;"></div>
            </div>
        </a></p>
    <p>所以我们需要一个中文分词器；<br>这里选择和 elasticsearch 配套的 ik-analyzer ；</p>
    <p>安装 ik-analyzer ；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash">/usr/share/elasticsearch/bin/elasticsearch-plugin <span class="token function">install</span> https://github.com/medcl/elasticsearch-analysis-ik/releases/download/v6.2.4/elasticsearch-analysis-ik-6.2.4.zip<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>如果报下面这种错误的话可能是网络不好；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash">Exception <span class="token keyword">in</span> thread <span class="token string">"main"</span> java.net.ConnectException: Connection timed out <span class="token punctuation">(</span>Connection timed out<span class="token punctuation">)</span>
at java.base/jdk.internal.reflect.NativeConstructorAccessorImpl.newInstance0<span class="token punctuation">(</span>Native Method<span class="token punctuation">)</span><span aria-hidden="true" class="line-numbers-rows"><span></span><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>沐浴更衣大念帅白最帅；<br>再试几次即可；</p>
    <p>然后重新启动下服务；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> systemctl restart elasticsearch<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>看下 ik-analyzer 的效果；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">curl</span> -H <span class="token string">'Content-Type: application/json'</span>  -XGET <span class="token string">'localhost:9200/_analyze?pretty'</span> -d <span class="token string">'{"analyzer":"ik_max_word","text":"白俊遥技术博客"}'</span><span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-7 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f8d104254.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f8d104254.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 750px; height: 546.344px; top: 0px; left: 0px;"></div>
            </div>
        </a><br>我们可以看到 技术 和 博客 两个词语已经成功组合到了一起；<br>然而本博主 白俊遥 的名字被硬生生的拆成了3个字这怎么忍；</p>
    <p>还好强大的 analysis-ik 支持自定义词库；<br>增加自定义词库；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">vim</span> /etc/elasticsearch/analysis-ik/IKAnalyzer.cfg.xml<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-8 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f8e5b6947.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f8e5b6947.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 647px; height: 214px; top: 0px; left: 0px;"></div>
            </div>
        </a><br>增加一个 白俊遥 到词库；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token builtin class-name">echo</span> <span class="token string">'白俊遥'</span> <span class="token operator">&gt;</span> /etc/elasticsearch/analysis-ik/baijunyao.dic<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>重新启动下服务；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">sudo</span> systemctl restart elasticsearch<span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p>再看下分词效果 ；</p>
    <div class="code-toolbar">
        <pre
            class="line-numbers language-bash"><code class=" language-bash"><span class="token function">curl</span> -H <span class="token string">'Content-Type: application/json'</span>  -XGET <span class="token string">'localhost:9200/_analyze?pretty'</span> -d <span class="token string">'{"analyzer":"ik_max_word","text":"白俊遥技术博客"}'</span><span aria-hidden="true" class="line-numbers-rows"><span></span></span></code></pre>
        <div class="toolbar">
            <div class="toolbar-item"><span>Bash</span></div>
            <div class="toolbar-item"><button>Copy</button></div>
        </div>
    </div>
    <p><a class="js-fluidbox fluidbox__instance-9 fluidbox--initialized fluidbox--closed fluidbox--ready"
            href="https://baijunyao.com/uploads/article/20180603/5b13f8fe670c5.jpg">
            <div class="fluidbox__wrap" style="z-index: 990;"><img src="https://baijunyao.com/uploads/article/20180603/5b13f8fe670c5.jpg"
                    alt="" title="" class="fluidbox__thumb" style="opacity: 1;">
                <div class="fluidbox__ghost" style="width: 750px; height: 402.906px; top: 0px; left: 0px;"></div>
            </div>
        </a><br>双击 666 ；<br>本来准备一口气把 elasticsearch 在 laravel 中的应用也写完的；<br>不过看着情形今个是完不成了；<br>下篇文章继续哈；</p>
    <p>另外给个用于在线测试的教程：<a href="https://cloud.tencent.com/developer/labs/lab/10433" target="_blank">腾讯云开发者实验室</a></p>
</div>
