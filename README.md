# 恋爱加减分记录 | Love Score Tracker

一款轻量的恋爱关系健康度追踪工具。通过记录日常事件的加减分，实时反映两人关系的状态走向。

*A lightweight relationship health tracker. Log daily moments as score changes and watch the story of your relationship unfold in real time.*

初始分值 **100 分**，低于 60 分进入「拉黑」状态，达到 140 分可获得「许愿」机会。

*Starts at **100 points**. Drop below 60 and you're in the danger zone. Reach 140 and you've earned a wish.*

---

> **这里记录的每一件事，都是你们共同走过的证明。**
>
> *Every entry here is proof of what you've been through together.*
>
> 双方写下的每一条评分记录，一经提交便永久封存，无法修改、无法删除。每条记录只允许对方回复一次，回复同样不可撤销。
>
> *Every score entry, once submitted, is sealed forever — it cannot be edited or deleted. Each record allows exactly one reply, and that reply is permanent too.*
>
> 这里没有后悔药，只有真实发生过的一切——属于你们两个人独一无二的恋爱时间轴与生命轨迹，忠实地记录在这里，不会被篡改，也不会消失。
>
> *No take-backs. No rewrites. Just the truth of what happened — your own irreplaceable timeline, faithfully preserved and impossible to falsify.*

---

## 截图 · Screenshots

<table>
  <tr>
    <td align="center"><b>主界面<br><sub>Main View</sub></b></td>
    <td align="center"><b>记录新事件<br><sub>Add Record</sub></b></td>
  </tr>
  <tr>
    <td><img src="screenshots/main-view.png" width="320" alt="主界面：分数头部与时间线记录"/></td>
    <td><img src="screenshots/add-record.png" width="320" alt="底部弹出的新增记录面板"/></td>
  </tr>
</table>

### 回复功能 · Reply Feature

每条评分记录支持回复一次，回复以气泡形式内嵌显示在记录下方，评分时间跟随描述文字行内展示。

*Each record supports one reply. Replies appear as inline chat bubbles beneath the entry, and timestamps are shown inline next to the description.*

<table>
  <tr>
    <td align="center"><b>回复气泡 · 行内时间<br><sub>Reply Bubble · Inline Timestamp</sub></b></td>
  </tr>
  <tr>
    <td><img src="screenshots/reply-feature.png" width="320" alt="回复气泡与行内时间展示"/></td>
  </tr>
</table>

---

## 功能特性 · Features

- **实时分数看板** — 渐变色头部大字展示当前总分，进度条直观呈现分数区间<br>*Live score dashboard — large gradient header shows the current total, with a progress bar spanning the danger–wish range*
- **时间线记录** — 按日期分组，显示每条事件的描述、行内时间、分值变化与累计分<br>*Timeline — entries grouped by date, showing description, inline timestamp, score delta, and running total*
- **快速加减分** — 预设 ±1 / ±2 / ±3 按钮 + 步进器，操作流畅<br>*Quick scoring — preset ±1 / ±2 / ±3 buttons plus a stepper for smooth input*
- **一次性回复** — 点击任意记录行即可回复一次，气泡内嵌展示，永久封存<br>*One-time reply — tap any entry to leave a single permanent reply, displayed as an inline bubble*
- **状态提醒** — 分数进入危险区或达成许愿条件时自动弹出提示<br>*Status alerts — automatic pop-ups when the score enters the danger zone or hits the wish threshold*
- **拉黑 / 许愿计数** — 头部记录历史穿越次数，一眼掌握关系起伏<br>*Danger & wish counters — header tracks how many times each threshold has been crossed*
- **离线可用** — 内置示例数据，无需后端即可查看完整界面效果<br>*Offline-ready — built-in sample data loads automatically when the backend is unavailable*
- **数据导出** — 一键导出 JSON 备份文件<br>*Export — one-tap JSON backup*

---

## 分数规则 · Scoring Rules

| 分数区间 · Range | 状态 · Status |
|-----------------|---------------|
| ≥ 140 | 许愿机会达成 · Wish unlocked |
| 80 – 139 | 安全，表现良好 · Safe zone |
| 60 – 79 | 接近危险，需注意 · Approaching danger |
| ≤ 60 | 已进入拉黑状态 · Danger zone |

---

## 技术栈 · Tech Stack

- **前端 · Frontend** — 纯 HTML + CSS + JavaScript，零依赖，单文件可运行<br>*Vanilla HTML / CSS / JS — zero dependencies, runs as a single file*
- **后端 · Backend**（可选 · optional） — PHP，`api.php` 提供 GET/POST 接口，数据存储为本地 `data.json`<br>*PHP — `api.php` exposes GET / POST endpoints; data is stored in a local `data.json` file*
- **部署 · Deploy** — 可托管于任意静态服务器或 GitHub Pages（离线模式）<br>*Deployable on any static host or GitHub Pages (offline mode with sample data)*

---

## 快速开始 · Quick Start

### 静态预览 · Static Preview（无需服务器 · no server required）

直接用浏览器打开 `index.html`，内置示例数据自动加载。

*Open `index.html` directly in a browser — sample data loads automatically.*

### 完整部署 · Full Deploy（需 PHP 环境 · requires PHP）

```bash
# 将项目文件放到 PHP 服务器目录
# Place project files in your PHP server's web root
# 确保 api.php 与 index.html 同级
# Ensure api.php and index.html are in the same directory
# data.json 会在首次 POST 时自动创建
# data.json is created automatically on the first POST request
```

---

## License

MIT
