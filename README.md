# Game of the Generals

A custom implementation of **Game of the Generals** (also known as *Salpakan*), the classic Philippine military-themed tactical board game. This game simulates hidden-information warfare, requiring strategy, bluffing, and psychological tactics to outmaneuver your opponent.

---

## 🎮 Game Overview

In Game of the Generals, two players command opposing armies with undisclosed ranks. Because pieces remain face-down to the opponent, players must deduce the enemy’s chain of command through elimination, daring moves, and careful observation.

### Winning Conditions

1. **Eliminate the Enemy Flag:** Eliminate the opponent's Flag using any mobile piece.
2. **Infiltrate the Flag:** Successfully maneuver your Flag to the opposite end of the board without it being captured or blocked by an opposing piece on an adjacent square.

---

## ⚔️ Ranks & Hierarchy

Pieces follow a strict hierarchy during combat. When two opposing pieces occupy the same space, the higher-ranking piece wins and eliminates the lower-ranking one.

| Rank | Piece Name | Qty | Special Rules & Elimination Dynamics |
| --- | --- | --- | --- |
| **5★** | Five-Star General | 1 | Eliminates 4-Star General and below. |
| **4★** | Four-Star General | 1 | Eliminates 3-Star General and below. |
| **3★** | Three-Star General | 1 | Eliminates 2-Star General and below. |
| **2★** | Two-Star General | 1 | Eliminates 1-Star General and below. |
| **1★** | One-Star General | 1 | Eliminates Colonel and below. |
| **COL** | Colonel | 1 | Eliminates Lt. Colonel and below. |
| **LTC** | Lt. Colonel | 1 | Eliminates Major and below. |
| **MAJ** | Major | 1 | Eliminates Captain and below. |
| **CPT** | Captain | 1 | Eliminates 1st Lieutenant and below. |
| **1LT** | 1st Lieutenant | 1 | Eliminates 2nd Lieutenant and below. |
| **2LT** | 2nd Lieutenant | 1 | Eliminates Sergeant and Privates. |
| **SGT** | Sergeant | 1 | Eliminates Privates only. |
| **PVT** | Private | 6 | **Eliminates Spy. |
| **SPY** | Spy | 2 | **Eliminates all Officers & Generals.** Eliminated **only** by Privates. |
| **FLAG** | Flag | 1 | Eliminated by **any** piece. Cannot capture any piece. |

*Note: If two pieces of equal rank challenge each other, both are eliminated.*

---

## 🚀 Getting Started

### Prerequisites

* [Node.js](https://nodejs.org/) (v16.0 or higher) *or* [Python](https://www.python.org/) (v3.8+) *(adjust based on your stack)*
* Git

### Installation

1. Clone the repository:
```bash
git clone https://github.com/your-username/game-of-the-generals.git

```


2. Navigate to the project directory:
```bash
cd game-of-the-generals

```


3. Install dependencies:
```bash
npm install

```



### Running the Game

Start the local development server:

```bash
npm start

```

---

## 🕹️ How to Play

1. **Setup Phase:** Both players arrange their 21 pieces on their respective rear 3 rows of the 9x8 grid.
2. **Movement:** Players take turns moving one piece per turn to an adjacent, unoccupied square (orthogonally: forward, backward, left, or right—no diagonal moves).
3. **Challenging:** Moving onto a square occupied by an enemy piece initiates an arbiter inspection. The piece with the lower rank is removed from the board.

---

## 🛠️ Built With

* **Frontend Framework:** React / Vue / Plain JavaScript *(Edit as needed)*
* **Styling:** Tailwind CSS / CSS Modules
* **State/Logic:** Custom Game Logic Engine

---

## 📄 License

Distributed under the MIT License. See `LICENSE` for more information."# the-games-of-the-generals" 
"# the-games-of-the-generals" 
